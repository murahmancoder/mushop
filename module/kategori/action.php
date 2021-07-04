<?php

include_once('../../functions/helper.php');
include_once('../../functions/koneksi.php');

admin_only("kategori", $level);

$kategori = isset($_POST['kategori'])?$_POST['kategori'] : "";
$status = isset($_POST['status'])?$_POST['status']:"";
$button = isset($_POST['button'])?$_POST['button'] : $_GET['button'];
$id = isset($_GET['id'])?$_GET['id'] : "";

//Tempat masuk ke database

if($button == 'Add'){
   mysqli_query($koneksi, "INSERT INTO kategori (kategori, status) VALUES ('$kategori', '$status')");
}else if($button == 'Update'){
   $id = $_GET['id'];
   mysqli_query($koneksi, "UPDATE kategori SET kategori='$kategori',
                           status='$status' WHERE kategori_id='$id'");
}
header('location:'.BASE_URL.'index.php?page=my_profile&module=kategori&action=list');