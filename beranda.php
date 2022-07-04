<!DOCTYPE html>
<html>
<?php
session_start();
if (!isset($_SESSION['username'])) {
	echo "<script>alert('Silahkan Login Dulu');location.href='login.php'</script>";
} else {
?>
<head>
	<title>Database Perpustakaan</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-inverse">
		<ul class="nav navbar-nav">
			<li class="active"><a href="beranda.php">Beranda</a></li>
			<li><a href="anggota.php">Anggota</a></li>
			<li><a href="buku.php">Buku</a></li>
			<li><a href="pinjam.php">Pinjam</a></li>
			<li><a style="color:red" onclick="return confirm('Yakin ingin keluar?')" href="logout.php">Logout</a></li>
		</ul>
	</nav>
	<div class="container">
		<div>
			<h1>SELAMAT DATANG DI DATABASE PERPUSTAKAAN</h1>
		</div>
	</div>
</body>
<?php } ?>
</html>