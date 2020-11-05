@extends('layouts.app')
@section('content')
@if ($errors->any())
	<div class="alert alert-danger">
	<ul>
	@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
	</ul>
	</div>
@endif
<body>
<div class="container-fluid p-5">
<h2>住所登録</h2>
<form method="post" action="{{ route('address.create') }}">
{{ csrf_field() }}
<table class="table table-striped">
<thead class="thead-dark">
<tr>
<th>column</th>
<th>contents</th>
</tr>
</thead>
<tbody>
<tr>
<td>氏名</td>
<td><input type="text" name="name" value="{{ old('name') }}"></td>
</tr>
<tr>
<td>郵便番号</td>
<td><input type="text" name="postal_code" value="{{ old('postal_code') }}"></td>
</tr>
<tr>
<td>都道府県</td>
<td><input type="text" name="region" value="{{ old('region') }}"></td>
</tr>
<tr>
<td>市区町村</td>
<td><input type="text" name="city" value="{{ old('city') }}"></td>
</tr>
<tr>
<td>その他住所</td>
<td><textarea cols="30" rows="5" name="street">{{ old('street') }}</textarea></td>
</tr>
<tr>
<td>電話番号</td>
<td><input type="text" name="phone_number" value="{{ old('phone_number') }}"></td>
</tr>
</tbody>
</table>
<p><button type="submit">新規登録</button></p>
</form>
<p><a href="{{ route('address.index') }}">住所一覧へ戻る</a></p>
</body>
@endsection
