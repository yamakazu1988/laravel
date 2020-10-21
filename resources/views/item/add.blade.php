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
<h2>商品登録</h2>
<form method="post" action="{{ route('admin.item.create') }}">
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
<td>name</td>
<td><input type="text" name="name" value="{{ old('name') }}"></td>
</tr>
<tr>
<td>description</td>
<td><textarea cols="30" rows="5" name="description">{{ old('description') }}</textarea></td>
</tr>
<tr>
<td>price</td>
<td><input type="text" name="price" value="{{ old('price') }}"></td>
</tr>
<tr>
<td>stock</td>
<td><input type="text" name="stock" value="{{ old('stock') }}"></td>
</tr>
</tbody>
</table>
<p><button type="submit">新規登録</button></p>
</form>
<p><a href="{{ route('admin.item.index') }}">商品一覧へ戻る</a></p>
</body>
@endsection
