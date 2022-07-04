<?php
include 'koneksi.php';

if (isset($_POST['pinjam'])) {

	$kd_pinjam = $_POST['kd_pinjam'];
	$kd_buku = $_POST['kd_buku'];
	$no_agt = $_POST['no_agt'];
	$pinjam = $_POST['tgl_pinjam'];
	$kembali = $_POST['tgl_kembali'];
	$status = 'pinjam';
	
	$cek_buku = mysqli_query($db, "SELECT * FROM buku WHERE kd_buku = '$kd_buku'");
	$cb = mysqli_num_rows($cek_buku);
	$cek_anggota = mysqli_query($db, "SELECT * FROM anggota WHERE no_agt = '$no_agt'");
	$ca = mysqli_num_rows($cek_anggota);

	if ($ca == 1) {
		if ($cb == 1) {
			$simpan = mysqli_query($db, "INSERT INTO peminjaman VALUES ('$kd_pinjam','$kd_buku','$no_agt','$pinjam','$kembali','','$status','','')");
			if ($pinjam) {
				echo "<script>alert('Peminjaman telah disimpan dalam database');location.href='pinjam.php';</script>";
			} else {
				echo "<script>alert('Gagal');window.history.back(1);</script>";
			}
		} else {
			echo "<script>alert('Buku tidak terdaftar');window.history.back(1);</script>";
		}
	} else {
		echo "<script>alert('Anggota tidak terdaftar');window.history.back(1);</script>";
	}

} elseif (isset($_POST['kembali'])) {
	$kd_pinjam = $_POST['kd_pinjam'];
	$status = 'kembali';
	$keterangan = $_POST['keterangan'];
	$denda = $_POST['denda'];
	$tgl_dikembalikan = $_POST['tgl_dikembalikan'];

	$kembali = mysqli_query($db, "UPDATE peminjaman SET status = '$status', keterangan = '$keterangan', denda = '$denda', tgl_dikembalikan = '$tgl_dikembalikan' WHERE kd_pinjam = '$kd_pinjam'");

	if ($kembali) {
		echo "<script>alert('Buku yang dipinjam telah dikembalikan');location.href='pinjam.php';</script>";
	} else {
		echo "<script>alert('Gagal');window.history.back(1);</script>";
	}
} else {
	echo "<script>alert('tidak ada proses')</script>";
}
?>