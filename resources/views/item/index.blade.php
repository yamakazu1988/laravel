@extends('layouts.app')
<?php $now_route = \Route::currentRouteName(); ?>
@section('content')
<body>
<div class="container-fluid p-5">
<h1>商品一覧</h1>
<hr>
@if ($errors->any())
@foreach ($errors->all() as $error)
<h3>{{ $error }}</h3>
@endforeach
@endif
@if (strpos($now_route, 'admin') !== false)
	<p><a href="{{ route('admin.item.add') }}">商品追加</a></p>
@elseif (strpos($now_route, 'admin') !== false)
@else
@endif
<table class="table table-striped">
<thead class="thead-dark">
<tr>
<th>name</th>
<th>price</th>
<th>stock</th>
</tr>
</thead>
<tbody>
@foreach ($items as $item)
<tr>
@if (strpos($now_route, 'admin') !== false)
<td><a href="{{ route('admin.item.detail', ['id' => $item->id]) }}">{{ $item->name }}</a></td>
@elseif (strpos($now_route, 'admin') === false)
<td><a href="{{ route('item.detail', ['id' => $item->id]) }}">{{ $item->name }}</a></td>
@endif
<td>{{ $item->price }}</td>
<td>
@if ($item->stock > 1)
在庫あり
@else
在庫無し
@endif
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</body>
@endsection
