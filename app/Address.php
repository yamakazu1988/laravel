<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\Facades\DB;

class Address extends Model
{
	use SoftDeletes;
	protected $fillable = ['user_id', 'cart_id'];
	protected $table = 'address';

	public function cart() {
		return $this->belongsTo('App\cart', 'cart_id');
	}
	public function all_get($auth_id) {
		$addresses = $this->where('user_id', $auth_id)->get();
		return $addresses;
	}
	public function soft_delete_db($address_id) {
		$address = $this->findOrFail($address_id);
		if ($address->user_id == Auth::id()) {
			$cart_id = $address->cart_id;
			$address->delete();
			session()->flash('msg_success', 'お届け先住所を削除しました');
			return true;
		}
		session()->flash('msg_error', '不正なアクセスです');
		return false;
	}
}
