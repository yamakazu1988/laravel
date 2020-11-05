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
		return redirect('/address/index')->with('message_success', 'お届け先住所を削除しました');
	}
	public function add() {
		return view('address.add');
	}
	public function create(AddressRequest $request) {
		$address = new Address;
		$address->user_id = Auth::id();
		$address->name = $request->name;
		$address->postal_code = $request->postal_code;
		$address->region = $request->region;
		$address->city = $request->city;
		$address->street = $request->street;
		$address->phone_number = $request->phone_number;
		$address->save();
		return redirect(route('address.index'))->with('message_success', 'お届け先住所を登録しました');
	}
	public function edit(Request $request) {
		try {
			$address = Address::findOrFail($request->id);
		} catch (ModelNotFoundException $e) {
			$error = '指定した住所は存在しません';
			return redirect(route('address.index'))->withErrors($error)->withInput();
		}
		return view('address.edit', compact('address'));
	}
	public function update(AddressRequest $request) {
		try {
			$address = Address::findOrFail($request->id);
		} catch (ModelNotFoundException $e) {
			$error = '指定した住所は存在しません';
			return redirect(route('address.index'))->withErrors($error)->withInput();
		}
		$address->name = $request->name;
		$address->postal_code = $request->postal_code;
		$address->region = $request->region;
		$address->city = $request->city;
		$address->street = $request->street;
		$address->phone_number = $request->phone_number;
		$address->save();
		return redirect(route('address.index'))->with('message_success', 'お届け先住所の情報を編集しました');
	}
}
