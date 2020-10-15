<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid p-5">
<h2>{{ $item->name }}</h2>
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
@if ($item->stock > 1)
在庫あり
@else
在庫無し
@endif
</td>
</tr>
</tbody>
</table>
<a href="{{ route('item.index') }}">商品一覧へ</a>
</div>
</body>
</html>
