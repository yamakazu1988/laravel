<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
	public function isAdminRoute() {
		$bool =strpos(\Route::currentRouteName(), 'admin') !== false;
		return $bool;
	}
	public function getUser() {
		if ($this->isAdminRoute()) {
			return Auth::guarf('admin')->user();
		} else {
			return Auth::guard('user')->user();
		}
	}
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
