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
    case 'update' : update() ; break;
    case 'delete' : delete() ; break;
    default : normal(); break;
}

function normal(){
    global $koneksi;
    $sql1 = "select * from user order by username desc";
    $q1 = mysqli_query($koneksi, $sql1);
    while($r1 = mysqli_fetch_array($q1)){
        $hasil[]= array(
            'nama_lengkap' => $r1['nama_lengkap'],
            'username' => $r1['username'],
            'password' => $r1['password'],
            'email' => $r1['email'],
            'alamat' => $r1['alamat'],
            'jenis_kelamin' => $r1['jenis_kelamin'],
            'no_telepon' => $r1['no_telepon'],
            'foto_profil' => $r1['foto_profil']
        );
    }

    $data['data']['result'] = $hasil;
    echo json_encode($data);
}

//function to create or add new user
function create(){
    global $koneksi;
    $username = $_POST['username']; 
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nama_lengkap = $_POST['nama_lengkap']; 
    $alamat = $_POST['alamat'];  
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_telepon = $_POST['no_telepon'];
    $foto_profil = $_POST['foto_profil'];
    

    $hasil = "Gagal menambah data, silahkan masukkan ulang";
    if($username and $email and $password and $alamat and $jenis_kelamin and $no_telepon and $foto_profil and $nama_lengkap){
        $sql1 = "insert into user(username, password,email, nama_lengkap, alamat, jenis_kelamin, no_telepon, foto_profil) values ('$username', '$password' ,'$email', '$nama_lengkap', '$alamat', '$jenis_kelamin', '$no_telepon', '$foto_profil')";
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
    $username = $_GET['username'];

    $sql1 = "select * from user where username = '$username'";
    $q1 = mysqli_query($koneksi, $sql1);

    while($r1 = mysqli_fetch_array($q1)){
        $hasil[]= array(
            'nama_lengkap' => $r1['nama_lengkap'],
            'username' => $r1['username'],
            'password' => $r1['password'],
            'email' => $r1['email'],
            'alamat' => $r1['alamat'],
            'jenis_kelamin' => $r1['jenis_kelamin'],
            'no_telepon' => $r1['no_telepon'],
            'foto_profil' => $r1['foto_profil']
        );
    }
    $data['data']['result'] = $hasil;
    echo json_encode($data);
}

// // function to update data user
function update(){
    global $koneksi;    
    $username = $_GET['username'];
    $nama_lengkap = $_POST['nama_lengkap'];   
    $password = $_POST['password']; 
    $email = $_POST['email'];  
    $alamat = $_POST['alamat'];  
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_telepon = $_POST['no_telepon'];
    $foto_profil = $_POST['foto_profil'];

  
    if ($nama_lengkap){
        $set[] = "nama_lengkap='$nama_lengkap'";
    }

    if ($password){
        $set[] = "password='$password'";
    }

    if ($email){
        $set[] = "email='$email'";
    }

    if ($alamat){
        $set[] = "alamat='$alamat'";
    }

    if ($jenis_kelamin){
        $set[] = "jenis_kelamin='$jenis_kelamin'";
    }

    if ($no_telepon){
        $set[] = "no_telepon='$no_telepon'";
    }

    if ($foto_profil){
        $set[] = "foto_profil='$foto_profil'";
    }

    $hasil = " Gagal mengupdate data";
    if($nama_lengkap or $password or $alamat or $email or $jenis_kelamin or $no_telp or $foto_profil){
        $sql1 = "update user set ".implode(",",$set). "where username = '$username'";
        $q1 = mysqli_query($koneksi, $sql1);
        if($q1){
            $hasil='Data telah diupdate';
        }
    }

    $data['data']['result'] = $hasil;
    echo json_encode($data);
}

//menghapus data user 
function delete(){
    global $koneksi;
    $username = $_GET['username'];
    $sql1 = "Delete from user where username = '$username'";
    $q1 = mysqli_query($koneksi, $sql1);

   
    if($sq1){
        $hasil = "Data telah berhasil dihapus";
    }else{
        $hasil = "Data gagal dihapus";
    }

    $data['data']['result'] = $hasil;
    echo json_encode($data);
}

    

