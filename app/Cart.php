<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
	use SoftDeletes;
	protected $fillable = ['user_id', 'item_id', 'stock'];
	protected $table = 'carts';

	public function item() {
		return $this->belongsTo('App\Item', 'item_id');
	}
	public function all_get($auth_id) {
		$carts = $this->where('user_id', $auth_id)->get();
		return $carts;
	}
	public function add_db($item_id, $add_stock) {
		$item = (new item)->findOrFail($item_id);
		$stock = $item->stock;
		if ($stock <= 0) {
			return false;
		}
		DB::transaction(function() use($item_id, $add_stock, $item) {
			$cart = $this->firstOrCreate(['user_id' => Auth::id(), 'item_id' => $item_id], ['stock' => 0]);
			$cart->increment('stock', $add_stock);
			$item->decrement('stock', $add_stock);
		});
		return true;
	}
	public function soft_delete_db($cart_id) {
		$cart = $this->findOrFail($cart_id);
		if ($cart->user_id == Auth::id()) {
			$item_id = $cart->item_id;
			$stock = $cart->stock;
			DB::transaction(function() use($cart, $item_id, $stock) {
				$cart->delete();
				$item = (new Item)->find($item_id);
				$item->increment('stock', $stock);
			});
			return true;
		}
		return false;
	}
	public function subtotal() {
		$result = $this->item->price * $this->stock;
		return $result;
	}
}
