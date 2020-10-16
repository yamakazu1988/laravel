<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid p-5">
<h1>商品説明</h1>
<hr>
@if ($errors->any())
@foreach ($errors->all() as $error)
<h3>{{ $error }}</h3>
@endforeach
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
<td><a href="{{ route('item.detail', ['id' => $item->id]) }}">{{ $item->name }}</a></td>
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
</html>
