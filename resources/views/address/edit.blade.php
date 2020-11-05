
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
<h2>住所編集</h2>
<form method="post" action="{{ route('address.update') }}">
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
<td>id</td>
<td>{{ $address->id }}</td>
<td><input type="hidden" name="id" value="{{ $address->id }}"></td>
</tr>
<tr>
<td>氏名</td>
<td>{{ $address->name }}</td>
@if ($errors->any())
<td><input type="text" name="name" value="{{ old('name') }}"></td>
@else
<td><input type="text" name="name" value="{{ $address->name }}"></td>
@endif
</tr>
<tr>
<td>郵便番号</td>
<td>{{ $address->postal_code }}</td>
@if ($errors->any())
<td><input type="text" name="postal_code" value="{{ old('postal_code') }}"></td>
@else
<td><input type="text" name="postal_code" value="{{ $address->postal_code }}"></td>
@endif
</tr>
<tr>
<td>都道府県</td>
<td>{{ $address->region }}</td>
@if ($errors->any())
<td><input type="text" name="region" value="{{ old('region') }}"></td>
@else
<td><input type="text" name="region" value="{{ $address->region }}"></td>
@endif
</tr>
<tr>
<td>市区町村</td>
<td>{{ $address->city }}</td>
@if ($errors->any())
<td><input type="text" name="city" value="{{ old('city') }}"></td>
@else
<td><input type="text" name="city" value="{{ $address->city }}"></td>
@endif
</tr>
<tr>
<td>その他住所</td>
<td>{{ $address->street }}</td>
@if ($errors->any())
<td><textarea cols="30" rows="5" name="street">{{ old('street') }}</textarea></td>
@else
<td><textarea cols="30" rows="5" name="street">{{ $address->street }}</textarea></td>
@endif
</tr>
<tr>
<td>電話番号</td>
<td>{{ $address->phone_number }}</td>
@if ($errors->any())
<td><input type="text" name="phone_number" value="{{ old('phone_number') }}"></td>
@else
<td><input type="text" name="phone_number" value="{{ $address->phone_number }}"></td>
@endif
</tr>
</tbody>
</table>
<p><button type="submit">編集</button></p>
</form>
<p><a href="{{ route('address.index') }}">住所一覧へ戻る</a></p>
</body>
@endsection
