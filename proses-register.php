<?php

include_once('functions/helper.php');
include_once('functions/koneksi.php');

//tiap ngisi form diTangkap
$nama = $_POST['nama'];
$email = $_POST['email'];
$notelp = $_POST['notelp'];
$alamat = $_POST['alamat'];
$password = md5($_POST['password']);
$re_password = md5($_POST['re_password']);
$level='customer';
$status='on';

//data post disimpan dilink 
unset($_POST['password']);
unset($_POST['re_password']);
//mengubah jadi url data dari post
$dataform = http_build_query($_POST);

//jika email sarua jang notif email
$query = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email'");

if(empty($nama) | empty($email) | empty($notelp) | empty($alamat)| empty($password)){
   header('location:' .BASE_URL.'index.php?page=register&notif=require&'.$dataform);
}else if($password != $re_password){
   header('location:' .BASE_URL.'index.php?page=register&notif=password&'.$dataform);
}else if(mysqli_num_rows($query) == TRUE){
   header('location:' .BASE_URL.'index.php?page=register&notif=email&'.$dataform);
}else{
    mysqli_query($koneksi, "INSERT INTO user (level, nama, email, alamat, phone, password, status)
                        VALUES ('$level', '$nama', '$email', '$alamat', '$notelp', '$password', '$status')"
                        );
      header('location:' .BASE_URL.'index.php?page=login');
      }
