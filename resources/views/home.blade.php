<?php
$now_route = \Route::currentRouteName();
$loginName = '';
if (strpos($now_route, 'admin') === false) {
	$loginName = Auth::guard('user')->user()->name;
} elseif (strpos($now_route, 'admin') !== false) {
	$loginName = Auth::guard('admin')->user()->name;
}
?>
@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">
{{ $loginName }}
</div>
<div class="panel-body">
@if (session('status'))
<div class="alert alert-success">
{{ session('status') }}
</div>
@endif

You are logged in!
</div>
</div>
</div>
</div>
</div>
@endsection
