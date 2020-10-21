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
<h2>商品編集</h2>
<form method="post" action="{{ route('admin.item.update') }}">
{{ csrf_field() }}
<table class="table table-striped">
<thead class="thead-dark">
<tr>
<th>column</th>
<th>contents</th>
<th>edited contents</th>
</tr>
</thead>
<tbody>
<tr>
<td>id</td>
<td>{{ $item->id }}</td>
<td><input type="hidden" name="id" value="{{ $item->id }}"></td>
</tr>
<tr>
<td>name</td>
<td>{{ $item->name }}</td>
@if ($errors->any())
<td><input type="text" name="name" value="{{ old('name') }}"></td>
@else
<td><input type="text" name="name" value="{{ $item->name }}"></td>
@endif
</tr>
<tr>
<td>description</td>
<td>{{ $item->description }}</td>
@if ($errors->any())
<td><textarea cols="30" rows="5" name="description">{{ old('description') }}</textarea></td>
@else
<td><textarea cols="30" rows="5" name="description">{{ $item->description }}</textarea></td>
@endif
</tr>
<tr>
<td>stock</td>
<td>{{ $item->stock }}</td>
@if ($errors->any())
<td><input type="text" name="stock" value="{{ old('stock') }}"></td>
@else
<td><input type="text" name="stock" value="{{ $item->stock }}"></td>
@endif
</tr>
</tbody>
</table>
<p><button type="submit">編集</button></p>
</form>
<p><a href="{{ route('admin.item.index') }}">商品一覧へ戻る</a></p>
</body>
@endsection
