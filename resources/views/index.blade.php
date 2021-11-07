<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	@if ($errors->any())
		<div class="alert alert-danger">
				<ul>
						@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
						@endforeach
				</ul>
		</div>
	@endif

	<form method="POST" action="/users" enctype="multipart/form-data">

		{{ csrf_field() }}

	<input type="file" id="file" name="file" class="form-control">

	<button type="submit">アップロード</button>

	</form>

</body>
</html>