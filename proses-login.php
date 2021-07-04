<?php
include_once('functions/helper.php');
include_once('functions/koneksi.php');

$email= $_POST['email'];
$password= md5($_POST['password']);

//cek ka database email dan pw
$query = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email' AND password='$password' AND status='on'");

if(mysqli_num_rows($query) == TRUE){
   $row = mysqli_fetch_assoc($query);
   //echo $row['nama'];
   
   session_start();
   //tiap data nu di db disimpan di session 
   $_SESSION['nama']= $row['nama'];
   $_SESSION['level']= $row['level'];
   $_SESSION['user_id']= $row['user_id'];

   if(isset($_SESSION["proses-pesanan"])){
      unset($_SESSION["proses-pesanan"]);
      header('location:'.BASE_URL.'index.php?page=data-pemesanan');
   }else{
      header('location:'.BASE_URL.'index.php?page=my_profile&module=pesanan&action=list');
   }   
}else{
   header('location:'.BASE_URL.'index.php?page=login&notif=true'); 
}

?>