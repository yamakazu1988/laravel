@extends('layouts.app')
@section('content')
<body>
<p><a href="{{ route('address.add') }}">新規登録</a></p>
@if (0 < $addresses->count())
<h2>お届け先住所</h2>
<table class="table table-striped">
<thead class="thead-dark">
<tr>
<th>選択</th>
<th>氏名</th>
<th>郵便番号</th>
<th>都道府県</th>
<th>市区町村</th>
<th>その他住所</th>
<th>電話番号</th>
<th></th>
<th></th>
</tr>
</thead>
@foreach ($addresses as $address)
<tbody>
<tr>
<td>{{ Form::radio('check') }}</td>
<td>{{ $address->name }}</td>
<td>{{ $address->postal_code }}</td>
<td>{{ $address->region }}</td>
<td>{{ $address->city }}</td>
<td>{{ $address->street }}</td>
<td>{{ $address->phone_number }}</td>
<td>
<p><a href="{{ route('address.edit') }}?id={{ $address->id }}">編集</a></p>
</td>
<td>
<form method="post" action="{{ route('address.delete') }}">
{{ csrf_field() }}
<input type="hidden" name="address_id" value="{{ $address->id }}">
<input type="hidden" name="_method" value="delete">
<button type="submit">削除</button>
</form>
</td>
</tr>
</tbody>
@endforeach
</table>
@else
<h2>お届け先住所の登録がありません</h2>
@endif
<p><a href="{{ route('cart.index') }}">カート一覧へ戻る</a></p>
</body>
@endsection
