@extends('layouts.app')
<?php $now_route = \Route::currentRouteName(); ?>
@section('content')
<body>
<div class="container-fluid p-5">
<h2>{{ $item->name }}</h2>
<br>
@if (Auth::guest())
ログインしてください
@else
@if ($item->stock > 0)
<form method="post" action="{{ route('cart.add') }}">
{{ csrf_field() }}
<td><input type="hidden" name="item_id" value="{{ $item->id }}"></td>
<p><button type="submit">商品追加</button></p>
</form>
@else
在庫無し
@endif
@endif
<table class="table table-striped">
<thead class="thead-dark">
<tr>
<th>description</th>
<th>price</th>
<th>stock</th>
</tr>
</thead>
<tbody>
<tr>
<td>{{ $item->description }}</td>
<td>{{ $item->price }}</td>
<td>
@if ($item->stock > 0)
在庫あり
@else
在庫無し
@endif
</td>
</tr>
</tbody>
</table>
@if (strpos($now_route, 'admin') !== false)
<p><a href="{{ route('admin.item.edit') }}?id={{ $item->id }}">編集</a></p>
<p><a href="{{ route('admin.item.index') }}">商品一覧へ</a></p>
@elseif (strpos($now_route, 'admin') === false)
<p><a href="{{ route('item.index') }}">商品一覧へ</a></p>
@endif
</div>
</body>
@endsection
