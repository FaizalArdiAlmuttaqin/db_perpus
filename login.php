<!DOCTYPE html>
<html>
<head>
	<title>Database Perpustakaan</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<h1>SELAMAT DATANG ADMIN PERPUSTAKAAN</h1>
	<div class="row">
		<div class="col-md-3" style="background-color: #ddd">
			<h3>Login Admin</h3>
			<form action="proses_login.php" method="POST">
				<div class="form-group">
					<label>Username</label>
					<input class="form-control" type="text" name="username" placeholder="Username">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control" placeholder="********">
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary" name="" value="Login">
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>