<?php
   include_once('functions/koneksi.php');
   include_once('functions/helper.php');

   session_start();

   $barang_id=$_GET['barang_id'];
   // jika ditambah lagi akan disimpan disini
   $keranjang=isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : false;
   
   // baca dari database
   $query=mysqli_query($koneksi,"SELECT nama_barang, gambar, harga FROM barang WHERE barang_id='$barang_id'");
   $row=mysqli_fetch_assoc($query);

   // Dibuat array dari data database dan ditamnbah quantity
   $keranjang[$barang_id]= [
      "nama_barang"=>$row['nama_barang'],
      "gambar"=>$row['gambar'],
      "harga"=>$row['harga'],
      // quantity beda sendiri supaya dikali dengan harga
      "quantity"=>1           
   ];

   // Dibuat session dari array keranjang-nya dikirim ke index
   $_SESSION['keranjang']=$keranjang;
   header('location:'.BASE_URL);




?>