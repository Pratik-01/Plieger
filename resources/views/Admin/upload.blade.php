<!DOCTYPE html>
<html>
<head>
	<title>upload file</title>
</head>
<body>
	<h3>upload a file</h3>
	<form action="{{ route('admin.store') }}" enctype="multipart/form-data" method="post">
	{{ csrf_field() }}
		<input type="file" name="image">
		<input type="submit" value="upload">
	</form>
</body>
</html>