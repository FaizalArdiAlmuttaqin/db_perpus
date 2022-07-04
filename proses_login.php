<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$cek_admin = mysqli_query($db, "SELECT * FROM admin WHERE username = '$username' AND password = '$password'");
$cek = mysqli_num_rows($cek_admin);

if ($cek == 1) {
	echo "<script>alert('Selamat datang $username');location.href='index.php';</script>";
	$_SESSION['username'] = $_POST['username'];
} else {
	echo "<script>alert('Gagal');window.history.back(1);</script>";
}
?>