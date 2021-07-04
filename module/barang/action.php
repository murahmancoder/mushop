<?php

include_once('../../functions/helper.php');
include_once('../../functions/koneksi.php');

admin_only("barang", $level);


$nama_barang=$_POST['nama_barang'];
$harga=$_POST['harga'];
$stok=$_POST['stok'];
$spesifikasi=$_POST['spesifikasi'];
$kategori_id = $_POST['kategori_id'];
$status = $_POST['status'];
$button = $_POST['button'];
$update_gambar='';

// untuk gambar
if(!empty($_FILES['gambar']['name'])){
$gambar = $_FILES['gambar']['name'];
move_uploaded_file($_FILES['gambar']['tmp_name'], "../../images/barang/".$gambar);
$update_gambar=", gambar='$gambar'";
}

//Tempat masuk ke database
if($button == 'Add'){
   mysqli_query($koneksi, "INSERT INTO barang (kategori_id, nama_barang, harga, spesifikasi, stok, gambar, status) 
                                       VALUES ('$kategori_id', '$nama_barang', '$harga', '$spesifikasi', '$stok', '$gambar', '$status')");
}else if($button == 'Update'){
   $id = $_GET['id'];
   mysqli_query($koneksi, "UPDATE barang SET kategori_id='$kategori_id',
                                             status='$status',
                                             nama_barang='$nama_barang',
                                             harga='$harga',
                                             spesifikasi='$spesifikasi',
                                             stok='$stok' 
                                             $update_gambar WHERE barang_id='$id'");
}
header('location:'.BASE_URL.'index.php?page=my_profile&module=barang&action=list');