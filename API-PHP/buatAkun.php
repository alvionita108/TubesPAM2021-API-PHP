<?php
include_once "koneksi.php";
$data = json_decode(file_get_contents('php://input'), true);

$username = $data['username'];
$password = $data['password'];

$sql = "insert into user(username, password) values ('$username', '$password')";
$info = array();
$info['sql'] = $sql;
if (mysqli_query($koneksi, $sql)) {
	$info = "Akun berhasil di daftarkan";
} else {
	$info = mysqli_error($koneksi);
}

mysqli_close($koneksi);
echo json_encode($info);
