<?php 

error_reporting(0);
$host = "localhost";
$user = "root";
$pass = "root";
$db = "danustera";

$koneksi =mysqli_connect($host, $user, $pass, $db);

$op = $_GET['op'];
switch($op){
    case '' : normal(); break;    
    case 'create' : create(); break;
    case 'detail' : detail() ; break;
    default : normal(); break;
}

function normal(){
    global $koneksi;
    $sql1 = "select * from user order by id_user desc";
    $q1 = mysqli_query($koneksi, $sql1);
    while($r1 = mysqli_fetch_array($q1)){
        $hasil[]= array(
            'id_user' => $r1['id_user'],
            'nama_lengkap' => $r1['nama_lengkap'],
            'username' => $r1['username'],
            'password' => $r1['password'],
            'email' => $r1['email'],
            'alamat' => $r1['alamat'],
            'jenis_kelamin' => $r1['jenis_kelamin'],
            'no_telp' => $r1['no_telp'],
            'foto_profil' => $r1['foto_profil']
        );
    }

    $data['data']['result'] = $hasil;
    echo json_encode($data);
}

//function to create or add new user
function create(){
    global $koneksi;
    $nama_lengkap = $_POST['nama_lengkap']; 
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $email = $_POST['email'];  
    $alamat = $_POST['alamat'];  
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_telp = $_POST['no_telp'];
    $foto_profil = $_POST['foto_profil'];

    $hasil = "Gagal menambah data";
    if($username and $email and $password){
        $sql1 = "insert into user(nama_lengkap, username, password,email, alamat, jenis_kelamin, no_telp, foto_profil) values ('$username',  '$password', '$email','$alamat', '$jenis_kelamin', '$no_telp', '$foto_profil')";
        $q1 = mysqli_query($koneksi, $sql1);
        if($q1){
            $hasil='Berhasil menambah data';
        }
    }
    $data['data']['result'] = $hasil;
    echo json_encode($data);
}

//function to get detail user
function detail(){
    global $koneksi;
    $id_user = $_GET['id_user'];

    $sql1 = "select * from user where id_user = '$id_user'";
    $q1 = mysqli_query($koneksi, $sql1);

    while($r1 = mysqli_fetch_array($q1)){
        $hasil[]= array(
            'id_user' => $r1['id_user'],
            'nama_lengkap' => $r1['nama_lengkap'],
            'username' => $r1['username'],
            'password' => $r1['password'],
            'email' => $r1['email'],
            'alamat' => $r1['alamat'],
            'jenis_kelamin' => $r1['jenis_kelamin'],
            'no_telp' => $r1['no_telp'],
            'foto_profil' => $r1['foto_profil']
        );
    }
    $data['data']['result'] = $hasil;
    echo json_encode($data);
}


    

