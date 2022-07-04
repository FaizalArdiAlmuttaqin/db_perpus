<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$telp = $_POST['telp'];
	$simpan = mysqli_query($db, "INSERT INTO anggota VALUES ('','$nama','$alamat','$telp')");
	if ($simpan) {
		echo "<script>alert('Anggota Berhasil Disimpan');location.href='anggota.php';</script>";
	} else {
		echo "<script>alert('Gagal');window.history.back(1);</script>";
	}
} elseif (isset($_POST['edit'])) {
	$no_agt = $_POST['no_agt'];
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$telp = $_POST['telp'];
	$update = mysqli_query($db, "UPDATE anggota SET nm_agt = '$nama', alamat = '$alamat', telp = '$telp' WHERE no_agt = '$no_agt'");
	if ($update) {
		echo "<script>alert('Anggota Berhasil Diupdate');location.href='anggota.php';</script>";
	} else {
		echo "<script>alert('Gagal');window.history.back(1);</script>";
	}
} elseif (isset($_POST['hapus'])) {
	$no_agt = $_GET['no_agt'];
	$delete = mysqli_query($db, "DELETE FROM anggota WHERE no_agt = '$no_agt'");
	if ($delete) {
		echo "<script>alert('Anggota Berhasil Dihapus');location.href='anggota.php';</script>";
	} else {
		echo "<script>alert('Gagal');window.history.back(1);</script>";
	}
}
?>