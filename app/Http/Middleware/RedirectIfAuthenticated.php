<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RedirectIfAuthenticated {
	public function handle($request, Closure $next, $guard = null) {
		if (Auth::guard($guard)->check()) {
			if (strcmp($guard, 'admin') == 0) {
				return redirect('/admin/home');
			} else {
				return redirect('/home');
			}
		}
		return $next($request);
	}
}
