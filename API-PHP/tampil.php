<?php
include_once "koneksi.php";

$sql = $koneksi->query("SELECT * FROM `makanan`");

while ($row = mysqli_fetch_array($sql)) {
    $hasil[] = array(
        'id_makanan' => $row['id_makanan'],
        'nama_makanan' => $row['nama_makanan'],
        'deskripsi_makanan' => $row['deskripsi_makanan'],
        'foto_makanan' => $row['foto_makanan'],
        'stok_harian' => $row['stok_harian'],
        'harga_satuan' => $row['harga_satuan'],
    );
}
$data['result'] = $hasil;

echo json_encode($data);
