<?php
include_once "koneksi.php";

$sql = $koneksi->query("SELECT * FROM `makanan`");

while ($row = mysqli_fetch_array($sql)) {
    $hasil[] = array(
        'id_makanan' => $row['id_makanan'],
        'nama_makanan' => $row['nama_makanan'],
        'deskripsi_makanan' => $row['deskripsi_makanan'],
    );
}

echo json_encode($hasil);
