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
  	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
</head>
<body>
	<nav class="navbar navbar-inverse">
		<ul class="nav navbar-nav">
			<li><a href="beranda.php">Beranda</a></li>
			<li class="active"><a href="anggota.php">Anggota</a></li>
			<li><a href="buku.php">Buku</a></li>
			<li><a href="pinjam.php">Pinjam</a></li>
			<li><a style="color:red" onclick="return confirm('Yakin ingin keluar?')" href="logout.php">Logout</a></li>
		</ul>
	</nav>
	<div class="container">
		<div class="row">
			<h1>Data Anggota</h1>
			<?php 
			include 'koneksi.php';
			if (isset($_POST['edit'])) {
				$no_agt = $_GET['no_agt'];
				$data = mysqli_query($db, "SELECT * FROM anggota WHERE no_agt = '$no_agt'");
				$d = mysqli_fetch_array($data);

				echo "<form action=\"proses_anggota.php\" method=\"POST\">
					<input class=\"form-control\" type=\"hidden\" name=\"no_agt\" value=\"$d[no_agt]\">
				<div class=\"form-group\">
					<label>Nama</label>
					<input class=\"form-control\" type=\"text\" name=\"nama\" placeholder=\"Nama Lengkap\" value=\"$d[nm_agt]\">
				</div>
				<div class=\"form-group\">
					<label>Alamat</label>
					<input class=\"form-control\" type=\"text\" name=\"alamat\" placeholder=\"Alamat\" value=\"$d[alamat]\">
				</div>
				<div class=\"form-group\">
					<label>Telp</label>
					<input class=\"form-control\" type=\"number\" name=\"telp\" placeholder=\"No telp\" value=\"$d[telp]\">
				</div>
				<div class=\"form-group\">
					<input class=\"btn btn-success\" type=\"submit\" value=\"Update\" name=\"edit\">
					<a class=\"btn btn-warning\" href=\"anggota.php\">Input</a>
				</div>
				</form>";
			} else {
				?>
				<form action="proses_anggota.php" method="POST">
					<div class="form-group">
						<label>Nama</label>
						<input class="form-control" type="text" name="nama" placeholder="Nama Lengkap" required="">
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<input class="form-control" type="text" name="alamat" placeholder="Alamat" required="">
					</div>
					<div class="form-group">
						<label>Telp</label>
						<input class="form-control" type="number" name="telp" placeholder="No telp" required="">
					</div>
					<div class="form-group">
						<input class="btn btn-success" type="submit" value="Simpan" name="simpan">
						<input class="btn btn-warning" type="reset" value="Reset" name="reset">
					</div>
				</form>
			<?php } ?>
			<table id="table" class="table table-bordered">
				<thead>
					<tr>
						<th>No AGT</th>
						<th>Nama</th>
						<th>Alamat</th>
						<th>Telp</th>
						<th>#</th>
					</tr>
				</thead>
				<?php
				include 'koneksi.php';
				$data = mysqli_query($db, "SELECT * FROM anggota");
				while ($d = mysqli_fetch_array($data)) {
					?>
					<tbody>
						<tr>
							<td><?php echo $d['no_agt']; ?></td>
							<td><?php echo $d['nm_agt']; ?></td>
							<td><?php echo $d['alamat']; ?></td>
							<td><?php echo $d['telp']; ?></td>
							<td>
								<form action="anggota.php?no_agt=<?php echo $d['no_agt'] ?>" method="POST">
									<input class="btn btn-primary" type="submit" value="Edit" name="edit">
								</form>
								<form action="proses_anggota.php?no_agt=<?php echo $d['no_agt'] ?>" method="POST">
									<input onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-danger" type="submit" value="Hapus" name="hapus">
								</form>
							</td>
						</tr>
					</tbody>
				<?php } ?>
			</table>
		</div>
	</div>
	<footer>
		<div class="fixed-bottom">
			<h5 align="center">Copyright By </h5>
		</div>
	</footer>
<script type="text/javascript">
	$(document).ready( function () {
	    $('#table').DataTable();
	} );
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</body>
<?php } ?>
</html>