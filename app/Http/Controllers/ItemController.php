<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Item;

class ItemController extends Controller {
	public function index() {
		$items = DB::table('items')->get();
		return view('item.index', ['items' => $items]);
	}
	public function detail($id) {
		$item = Item::findOrFail($id);
		return view('item.detail', ['item' => $item]);
	}
}
