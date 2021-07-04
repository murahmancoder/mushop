<?php
session_start();

include_once('functions/helper.php');
include_once('functions/koneksi.php');

$page = isset($_GET['page']) ? $_GET['page'] : false;
$kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : false;

// cek session dan masukan dalam var agar bisa dpake di tempat lain 
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : false;
$level = isset($_SESSION['level']) ? $_SESSION['level'] : false;
// lalu buat agar login dan register tidak masuk dan ditendang kehalaman utama

//untuk keranjang
$keranjang=isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : array();
$totalBarang = count($keranjang);


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Muraman Shop</title>
   <link rel="stylesheet" href="<?= BASE_URL.'css/style.css'; ?>">
   <link rel="stylesheet" href="<?= BASE_URL.'css/banner.css'; ?>">
   <script src="<?= BASE_URL.'js/jquery-1.9.1.min.js';?>"></script>
   <script src="<?= BASE_URL.'js/SlidesJs/source/jquery.slides.min.js';?>"></script>

   <script>
    $(function() {
      $('#slides').slidesjs({
        height: 420,
        play: {auto : true,
               interval : 3000 },
        navigation: false
      });
    });
  </script>
</head>
<body>

   <div id="container">
   <div id="header">
        
         <div id="menu">
            
            <div id="user">   
            <?php
               if($user_id){
                  echo "HI <b>$nama</b> , 
                        <a href='".BASE_URL."index.php?page=my_profile&module=pesanan&action=list'>
                        <b>My Profile </b> 
                        </a>
                        <a href='".BASE_URL."logout.php'> Logout </a>";
               }else{
                  echo " <a href='".BASE_URL."index.php?page=login' >Login</a>
                        <a href='".BASE_URL."index.php?page=register'>Register</a>";
               }
            ?>   
                  
            </div>

            <a href="<?= BASE_URL.'index.php';?>" id="button-mushop">
               MuramanSHOP
            </a>

            <a href="<?= BASE_URL.'index.php?page=keranjang';?>" id="button-keranjang">
               <img src="<?= BASE_URL.'images/cart.png';?>" >
               <?php
                  if($totalBarang != 0){
                     echo"<span class='total-barang'>$totalBarang</span>";
                  }
               ?>
            </a>   
             
         </div>
      </div>

      <div id="content">

         <?php 
            $filename = "$page.php";
            if (file_exists($filename)){
               include_once($filename);
            }else{
               include_once("main.php");            
            }
         ?>


      </div>
      <div id="footer">
         <p>Copyright 2018</p>
      </div>
   </div>
   
</body>
</html>