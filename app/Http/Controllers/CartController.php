<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use App\Cart;

class CartController extends Controller {
	public function __construct(Cart $cart) {
		$this->cart = $cart;
	}
	public function index() {
		$carts = $this->cart->all_get(Auth::id());
		$subtotals = $this->subtotals($carts);
		$totals = $this->totals($carts);
		return view('cart.index', compact('carts', 'totals', 'subtotals'));
	}
	private function subtotals($carts) {
		$result = 0;
		foreach ($carts as $cart) {
			$result += $cart->subtotal();
		}
		return $result;
	}
	private function totals($carts) {
		$result = $this->subtotals($carts) + $this->tax($carts);
		return $result;
	}
	private function tax($carts) {
		$result = floor($this->subtotals($carts) * 0.1);
		return $result;
	}
	public function add(Request $request) {
		$item_id = $request->input('item_id');
		if ($this->cart->add_db($item_id, 1)) {
			session()->flash('msg_success', '商品をカートに追加しました');
			return redirect('/cart/index');
		} else {
			session()->flash('msg_error', '商品の在庫がありません');
			return redirect('/cart/index');
		}
	}
	public function delete(Request $request) {
		$cart_id = $request->input('cart_id');
		$this->cart->soft_delete_db($cart_id);
		session()->flash('msg_success', 'カート内の商品を削除しました');
		return redirect('/cart/index');
	}
}
