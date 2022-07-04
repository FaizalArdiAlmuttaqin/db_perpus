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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<?php
    include 'koneksi.php';
    $cek_kd_buku = mysqli_query($db, "SELECT MAX(kd_buku) FROM buku") or die (mysqli_error());
    $cek = mysqli_fetch_array($cek_kd_buku);
    if ($cek) {
        $nk = substr($cek[0], 1);
        $kode = (int)$nk;
        $kode = $kode + 1;
        $kd_buku = "B".str_pad($kode, 4,"0",STR_PAD_LEFT);
    } else {
            $kd_buku = "B0001";
    }
?>
<body>
	<nav class="navbar navbar-inverse">
		<ul class="nav navbar-nav">
			<li><a href="beranda.php">Beranda</a></li>
			<li><a href="anggota.php">Anggota</a></li>
			<li class="active"><a href="buku.php">Buku</a></li>
			<li><a href="pinjam.php">Pinjam</a></li>
			<li><a style="color:red" onclick="return confirm('Yakin ingin keluar?')" href="logout.php">Logout</a></li>
		</ul>
	</nav>
	<div class="container">
		<div>
			<h1>Data Buku</h1>
			<?php 
			include 'koneksi.php';
			if (isset($_POST['edit'])) {
				$kd_buku = $_GET['kd_buku'];
				$data = mysqli_query($db, "SELECT * FROM buku WHERE kd_buku = '$kd_buku'");
				$d = mysqli_fetch_array($data);

				echo "<form action=\"proses_buku.php\" method=\"POST\">
				<div class=\"form-group\">
					<label>Kode</label>
					<input class=\"form-control\" type=\"text\" name=\"kd_buku\" maxlength=\"5\" value=\"$kd_buku\" readonly>
				</div>
				<div class=\"form-group\">
					<label>Judul</label>
					<input class=\"form-control\" type=\"text\" name=\"judul\" value=\"$d[judul]\">
				</div>
				<div class=\"form-group\">
					<label>Pengarang</label>
					<input class=\"form-control\" type=\"text\" name=\"pengarang\" value=\"$d[pengarang]\">
				</div>
				<div class=\"form-group\">
					<label>Hal</label>
					<input class=\"form-control\" type=\"number\" name=\"hal\" value=\"$d[jml_hal]\">
				</div>
				<div class=\"form-group\">
					<label>Penerbit</label>
					<input class=\"form-control\" type=\"text\" name=\"penerbit\" value=\"$d[penerbit]\">
				</div>
				<div class=\"form-group\">
					<label>Tahun</label>
					<input class=\"form-control\" type=\"number\" name=\"tahun\" value=\"$d[tahun_terbit]\">
				</div>
				<div class=\"form-group\">
					<label>Tanggal</label>
					<input class=\"form-control\" type=\"date\" name=\"tanggal\" value=\"$d[tgl_masuk]\">
				</div>
				<div class=\"form-group\">
					<label>Jumlah</label>
					<input class=\"form-control\" type=\"number\" name=\"jml\" value=\"$d[stok]\">
				</div>
				<div class=\"form-group\">
					<label>Genre</label>
					<select class=\"form-control\" name=\"genre\">
						<option>$d[genre]</option>
						<option>Romance</option>
						<option>Comedy</option>
						<option>Action</option>
						<option>Historical</option>
						<option>Sci-fi</option>
						<option>Fiksi</option>
						<option>Lainnya</option>
					</select>
				</div>
				<div class=\"form-group\">
					<label>Kategory</label>
					<select class=\"form-control\" name=\"kategori\">
						<option>$d[kategori]</option>
						<option>Komik</option>
						<option>Novel</option>
						<option>Biografi</option>
						<option>Pelajaran</option>
						<option>Majala</option>
						<option>Wikipedia</option>
						<option>Lainnya</option>
					</select>
				</div>
				<div class=\"form-group\">
					<input class=\"btn btn-primary\" type=\"submit\" value=\"Update\" name=\"edit\">
					<a class=\"btn btn-warning\" href=\"buku.php\">Input</a>
				</div>
				</form>";
			} else {
				?>
				<form action="proses_buku.php" method="POST">
					<div class="form-group">
						<label>Kode</label>
						<input class="form-control" type="text" name="kd_buku" maxlength="5" value="<?php echo $kd_buku ?>" readonly>
					</div>
					<div class="form-group">
						<label>Judul</label>
						<input class="form-control" type="text" name="judul" placeholder="Judul Buku">
					</div class="form-group">
					<div class="form-group">
						<label>Pengarang</label>
						<input class="form-control" type="text" name="pengarang" placeholder="Pengarang">
					</div>
					<div class="form-group">
						<label>Hal</label>
						<input class="form-control" type="number" name="hal" placeholder="Jumlah halaman">
					</div>
					<div class="form-group">
						<label>Penerbit</label>
						<input class="form-control" type="text" name="penerbit" placeholder="Penerbit">
					</div>
					<div class="form-group">
						<label>Tahun</label>
						<input class="form-control" type="number" name="tahun" placeholder="Tahun Terbit">
					</div>
					<div class="form-group">
						<label>Tanggal</label>
						<input class="form-control" type="date" name="tanggal">
					</div>
					<div class="form-group">
						<label>Jumlah</label>
						<input class="form-control" type="number" name="jml" placeholder="Jumlah Buku">
					</div>
					<div class="form-group">
						<label>Genre</label>
						<select class="form-control" name="genre">
							<option>Romance</option>
							<option>Comedy</option>
							<option>Action</option>
							<option>Historical</option>
							<option>Sci-fi</option>
							<option>Fiksi</option>
							<option>Lainnya</option>
						</select>
					</div>
					<div class="form-group">
						<label>Kategory</label>
						<select class="form-control" name="kategori">
							<option>Komik</option>
							<option>Novel</option>
							<option>Biografi</option>
							<option>Pelajaran</option>
							<option>Majala</option>
							<option>Wikipedia</option>
							<option>Lainnya</option>
						</select>
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
						<th>Kode</th>
						<th>Judul</th>
						<th>Pengarang</th>
						<th>Penerbit</th>
						<th>Tahun</th>
						<th>Halaman</th>
						<th>Stok</th>
						<th>Tanggal</th>
						<th>Kategori</th>
						<th>Genre</th>
						<th>#</th>
					</tr>
				</thead>
				<?php
				include 'koneksi.php';
				$data = mysqli_query($db, "SELECT * FROM buku");
				while ($d = mysqli_fetch_array($data)) {
					?>
					<tbody>
						<tr>
							<td><?php echo $d['kd_buku']; ?></td>
							<td><?php echo $d['judul']; ?></td>
							<td><?php echo $d['pengarang']; ?></td>
							<td><?php echo $d['penerbit']; ?></td>
							<td><?php echo $d['tahun_terbit']; ?></td>
							<td><?php echo $d['jml_hal']; ?> Halaman</td>
							<td><?php echo $d['stok']; ?></td>
							<td><?php echo $d['tgl_masuk']; ?></td>
							<td><?php echo $d['kategori']; ?></td>
							<td><?php echo $d['genre']; ?></td>
							<td>
								<form action="buku.php?kd_buku=<?php echo $d['kd_buku'] ?>" method="POST">
									<input type="submit" value="Edit" class="btn btn-primary" name="edit">
								</form>
								<form action="proses_buku.php?kd_buku=<?php echo $d['kd_buku'] ?>" method="POST">
									<input onclick="return confirm('Yakin ingin menghapus data?')" type="submit" value="Hapus" class="btn btn-danger" name="hapus">
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