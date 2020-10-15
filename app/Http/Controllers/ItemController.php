<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Item;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ItemController extends Controller {
	public function index() {
		$items = Item::all();
		return view('item.index', ['items' => $items]);
	}
	public function detail($id) {
		try {
			$item = Item::findOrFail($id);
		} catch (ModelNotFoundException $e) {
			$error = '指定した商品は存在しません';
			return redirect('item/index')->withErrors($error)->withInput();
		}
		return view('item.detail', ['item' => $item]);
	}
}
