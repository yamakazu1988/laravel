<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Item;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\ItemRequest;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller {
	public function isAdminRoute() {
		$bool =strpos(\Route::currentRouteName(), 'admin') !== false;
		return $bool;
	}
	public function getUser() {
		if ($this->isAdminRoute()) {
			return Auth::guard('admin')->user();
		} else {
			return Auth::guard('user')->user();
		}
	}
    public function __construct()
    {
        $this->middleware('auth');
    }
	public function index() {
		$items = Item::all();
		return view('item.index', compact('items'));
	}
	public function detail($id) {
		try {
			$item = Item::findOrFail($id);
		} catch (ModelNotFoundException $e) {
			$error = '指定した商品は存在しません';
			if ($this->isAdminRoute()) {
				return redirect('admin/item/index')->withErrors($error)->withInput();
			} else {
				return redirect('item/index')->withErrors($error)->withInput();
			}
		}
		return view('item.detail', compact('item'));
	}

	public function add() {
		return view('item.add');
	}
	public function create(ItemRequest $request) {
		$item = new Item;
		$item->name = $request->name;
		$item->description = $request->description;
		$item->price = $request->price;
		$item->stock = $request->stock;
		$item->save();
		return redirect(route('admin.item.index'));
	}
	public function edit(Request $request) {
		try {
			$item = Item::findOrFail($request->id);
		} catch (ModelNotFoundException $e) {
			$error = '指定した商品は存在しません';
			return redirect(route('admin.item.index'))->withErrors($error)->withInput();
		}
		return view('item.edit', compact('item'));
	}
	public function update(ItemRequest $request) {
		try {
			$item = Item::findOrFail($request->id);
		} catch (ModelNotFoundException $e) {
			$error = '指定した商品は存在しません';
			return redirect(route('admin.item.index'))->withErrors($error)->withInput();
		}
		$item->name = $request->name;
		$item->description = $request->description;
		$item->stock = $request->stock;
		$item->save();
		return redirect(route('admin.item.detail', compact('item')));
	}
}
