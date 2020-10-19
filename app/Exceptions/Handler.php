<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {
	protected $dontReport = [
		//
	];
	protected $dontFlash = [
		'password',
		'password_confirmation',
	];
	public function report(Exception $exception) {
		parent::report($exception);
	}
	public function render($request, Exception $exception) {
		return parent::render($request, $exception);
	}
	public function unauthenticated($request, AuthenticationException $exception) {
		if ($request->expectsJson()) {
			return response()->json(['message' => $exception->getMessage()], 401);
		}
		if (in_array('admin', $exception->guards())) {
			return redirect()->guest(route('admin.login'));
		}
		return redirect()->guest(route('login'));
	}
}
