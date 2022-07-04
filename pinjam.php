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
<?php
include 'koneksi.php';
$cek_kd_pinjam = mysqli_query($db, "SELECT MAX(kd_pinjam) FROM peminjaman") or die (mysqli_error());
$cek = mysqli_fetch_array($cek_kd_pinjam);
if ($cek) {
	$nk = substr($cek[0], 1);
	$kode = (int)$nk;
	$kode = $kode + 1;
	$kd_pinjam = "P".str_pad($kode, 4,"0",STR_PAD_LEFT);
} else {
		$kd_pinjam = "P0001";
}
?>
<body>
	<nav class="navbar navbar-inverse">
		<ul class="nav navbar-nav">
			<li><a href="beranda.php">Beranda</a></li>
			<li><a href="anggota.php">Anggota</a></li>
			<li><a href="buku.php">Buku</a></li>
			<li class="active"><a href="pinjam.php">Pinjam</a></li>
			<li><a style="color:red" onclick="return confirm('Yakin ingin keluar?')" href="logout.php">Logout</a></li>
		</ul>
	</nav>
	<div class="container">
		<div>
			<h1>Data Peminjaman</h1>
			<?php 
			include 'koneksi.php';
			if (isset($_POST['kembali'])) {
				$kd_pinjam = $_GET['kd_pinjam'];
				$data = mysqli_query($db, "SELECT * FROM peminjaman WHERE kd_pinjam = '$kd_pinjam'");
				$d = mysqli_fetch_array($data);

				date_default_timezone_set('Asia/Jakarta');
				$sekarang = date('Y-m-d');

				echo "
				<form action=\"proses_pinjam.php\" method=\"POST\">
					<div class=\"form-group\">
						<label>Kode</label>
						<input class=\"form-control\" type=\"text\" name=\"kd_pinjam\" maxlength=\"5\" value=\"$kd_pinjam\" readonly>
					</div>
					<div class=\"form-group\">
						<label>Buku</label>
						<input class=\"form-control\" type=\"text\" name=\"kd_buku\" maxlength=\"5\" value=\"$d[kd_buku]\" readonly>
					</div>
					<div class=\"form-group\">
						<label>Anggota</label>
						<input class=\"form-control\" type=\"text\" name=\"no_agt\" maxlength=\"5\" value=\"$d[no_agt]\" readonly>
					</div>
					<div class=\"form-group\">
						<label>Pinjam</label>
						<input class=\"form-control\" type=\"date\" name=\"tgl_pinjam\" value=\"$d[tgl_pinjam]\" readonly>
					</div>
					<div class=\"form-group\">
						<label>Kembali</label>
						<input class=\"form-control\" type=\"date\" name=\"tgl_kembali\" value=\"$d[tgl_kembali]\" readonly>
					</div>
					<div class=\"form-group\">
						<label>DiKembalikan</label>
						<input class=\"form-control\" type=\"date\" name=\"tgl_dikembalikan\" value=\"$sekarang\" readonly>
					</div>
					<div class=\"form-group\">
						<label>Keterangan</label>
						<input class=\"form-control\" type=\"text\" name=\"keterangan\">
					</div>
					<div class=\"form-group\">
						<label>Denda</label>
						<input class=\"form-control\" type=\"number\" name=\"denda\" placeholder=\"jumlah denda\">
					</div>
					<div class=\"form-group\">
						<input class=\"btn btn-success\" type=\"submit\" value=\"Proses\" name=\"kembali\">	
					</div>
				</form>";
			} else {
					?>
				<form action="proses_pinjam.php" method="POST">
					<div class="form-group">
						<label>Kode</label>
						<input class="form-control" type="text" name="kd_pinjam" maxlength="5" value="<?php echo $kd_pinjam ?>" readonly>
					</div>
					<div class="form-group">
						<label>Kode Buku</label>
						<input class="form-control" type="text" name="kd_buku" maxlength="5" placeholder="Kode Buku">
					</div>
					<div class="form-group">
						<label>No Anggota</label>
						<input class="form-control" type="text" name="no_agt" maxlength="5" placeholder="No Anggota">
					</div>
					<div class="form-group">
						<label>Tanggal Pinjam</label>
						<input class="form-control" type="date" name="tgl_pinjam">
					</div>
					<div class="form-group">
						<label>Tanggal Kembali</label>
						<input class="form-control" type="date" name="tgl_kembali">
					</div>
					<div class="form-group">
						<input class="btn btn-success" type="submit" value="Proses" name="pinjam">
					</div>
				</form>
				<?php } ?>
				<table id="table" class="table table-bordered" border="1">
					<thead>
						<tr>
							<th>Kode</th>
							<th>Buku</th>
							<th>Anggota</th>
							<th>pinjam</th>
							<th>Kembali</th>
							<th>Dikembalikan</th>
							<th>Status</th>
							<th>Keterangan</th>
							<th>Denda</th>
							<th>#</th>
						</tr>
					</thead>
					<?php
					include 'koneksi.php';
					$data = mysqli_query($db, "SELECT * FROM peminjaman");
					while ($d = mysqli_fetch_array($data)) {
						?>
					<tbody>
						<tr>
							<td><?php echo $d['kd_pinjam']; ?></td>
							<td><?php echo $d['kd_buku']; ?></td>
							<td><?php echo $d['no_agt']; ?></td>
							<td><?php echo $d['tgl_pinjam']; ?></td>
							<td><?php echo $d['tgl_kembali']; ?></td>
							<td><?php echo $d['tgl_dikembalikan']; ?></td>
							<td><?php echo $d['status']; ?></td>
							<td><?php echo $d['keterangan']; ?></td>
							<td><?php echo $d['denda']; ?></td>
							<?php
							if ($d['status'] == 'kembali') {
								echo "<td>Selesai</td>";
							} else {
								echo "
								<td>
									<form action=\"pinjam.php?kd_pinjam=$d[kd_pinjam]\" method=\"POST\">
										<input class=\"btn btn-primary\" type=\"submit\" value=\"Kembali\" name=\"kembali\">
									</form>
								</td>
									";
							}
							?>
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