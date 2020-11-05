@extends('layouts.app')
@section('content')
<body>
@if (0 < $carts->count())
<h2>カート内容</h2>
<p><a href="{{ route('address.index') }}">お届け先選択</a></p>
<table class="table table-striped">
<thead class="thead-dark">
<tr>
<th>商品名</th>
<th>購入数</th>
<th>価格</th>
<th>削除</th>
</tr>
</thead>
@foreach ($carts as $cart)
<tbody>
<tr>
<td>{{ $cart->item->name }}</td>
<td>{{ $cart->stock }}</td>
<td>{{ $cart->subtotal() }}</td>
<td>
<form method="post" action="{{ route('cart.delete') }}">
{{ csrf_field() }}
<input type="hidden" name="cart_id" value="{{ $cart->id }}">
<input type="hidden" name="_method" value="delete">
<button type="submit">削除</button>
</form>
</td>
</tr>
@endforeach
<tr style="background-color:#f5f5f5">
<td>合計</td>
<td>{{ $subtotals }}</td>
<td>税込: {{ $totals }}</td>
<td></td>
</tr>
</tbody>
</table>
@else
<h2>カートが空です</h2>
@endif
<p><a href="{{ route('item.index') }}">商品一覧へ戻る</a></p>
</body>
@endsection
