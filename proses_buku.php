<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
	$kd_buku = $_POST['kd_buku'];
	$judul = $_POST['judul'];
	$pengarang = $_POST['pengarang'];
	$hal = $_POST['hal'];
	$penerbit = $_POST['penerbit'];
	$tahun = $_POST['tahun'];
	$tanggal = $_POST['tanggal'];
	$jumlah = $_POST['jml'];
	$genre = $_POST['genre'];
	$kategori = $_POST['kategori'];
	$simpan = mysqli_query($db, "INSERT INTO buku VALUES ('$kd_buku','$judul','$pengarang','$hal','$penerbit','$tahun','$tanggal','$jumlah','$genre','$kategori')");
	if ($simpan) {
		echo "<script>alert('Buku Berhasil Disimpan');location.href='buku.php';</script>";
	} else {
		echo "<script>alert('Gagal');window.history.back(1);</script>";
	}
} elseif (isset($_POST['edit'])) {
	$kd_buku = $_POST['kd_buku'];
	$judul = $_POST['judul'];
	$pengarang = $_POST['pengarang'];
	$hal = $_POST['hal'];
	$penerbit = $_POST['penerbit'];
	$tahun = $_POST['tahun'];
	$tanggal = $_POST['tanggal'];
	$jumlah = $_POST['jml'];
	$genre = $_POST['genre'];
	$kategori = $_POST['kategori'];
	$update = mysqli_query($db, "UPDATE buku SET judul = '$judul', pengarang = '$pengarang', jml_hal = '$hal', penerbit = '$penerbit', tahun_terbit = '$tahun', tgl_masuk = '$tanggal', stok = '$jumlah', genre = '$genre', kategori = '$kategori' WHERE kd_buku = '$kd_buku'");
	if ($update) {
		echo "<script>alert('Buku Berhasil Diupdate');location.href='buku.php';</script>";
	} else {
		echo "<script>alert('Gagal');window.history.back(1);</script>";
	}
} elseif (isset($_POST['hapus'])) {
	$kd_buku = $_GET['kd_buku'];
	$delete = mysqli_query($db, "DELETE FROM buku WHERE kd_buku = '$kd_buku'");
	if ($delete) {
		echo "<script>alert('Buku Berhasil Dihapus');location.href='buku.php';</script>";
	} else {
		echo "<script>alert('Gagal');window.history.back(1);</script>";
	}
}
?>