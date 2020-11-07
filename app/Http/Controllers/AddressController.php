<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use App\Http\Requests\AddressRequest;
use App\Address;

class AddressController extends Controller {
	public function __construct(Address $address) {
		$this->address = $address;
	}
	public function index() {
		$addresses = $this->address->all_get(Auth::id());
		return view('address.index', compact('addresses'));
	}
	public function delete(Request $request) {
		$address_id = $request->input('address_id');
		$this->address->soft_delete_db($address_id);
		return redirect(route('address.index'));
	}
	public function add() {
		return view('address.add');
	}
	public function create(AddressRequest $request) {
		$query = Address::query();
		$query->where('user_id', Auth::id());
		$query->where('postal_code', $request->postal_code);
		$query->where('region', $request->region);
		$query->where('city', $request->city);
		$query->where('street', $request->street);
		$query->whereNull('deleted_at');
		$address = $query->get()->count();
		if ($address > 0) {
			session()->flash('msg_error', 'お届け先住所が重複しております');
			return redirect(route('address.add'))->withInput();
		} else {
			$address = new Address;
			$address->user_id = Auth::id();
			$address->name = $request->name;
			$address->postal_code = $request->postal_code;
			$address->region = $request->region;
			$address->city = $request->city;
			$address->street = $request->street;
			$address->phone_number = $request->phone_number;
			$address->save();
			session()->flash('msg_success', 'お届け先住所を登録しました');
			return redirect(route('address.index'));
		}
	}
	public function edit(Request $request) {
		try {
			$address = Address::findOrFail($request->id);
		} catch (ModelNotFoundException $e) {
			session()->flash('msg_error', '指定した情報は存在しません');
			return redirect(route('address.index'));
		}
		if ($address->user_id !== Auth::id()) {
			session()->flash('msg_error', '不正なアクセスです');
			return redirect(route('address.index'));
		}
		return view('address.edit', compact('address'));
	}
	public function update(AddressRequest $request) {
		try {
			$address = Address::findOrFail($request->id);
		} catch (ModelNotFoundException $e) {
			session()->flash('msg_error', '指定した情報は存在しません');
			return redirect(route('address.index'));
		}
		$address->name = $request->name;
		$address->postal_code = $request->postal_code;
		$address->region = $request->region;
		$address->city = $request->city;
		$address->street = $request->street;
		$address->phone_number = $request->phone_number;
		$address->save();
		session()->flash('msg_success', 'お届け先住所の情報を編集しました');
		return redirect(route('address.index'));
	}
}
