<?php
// karena ajax jadi dihalaman itu dieksekusinya
session_start();

$keranjang = $_SESSION["keranjang"];
$barang_id =$_POST["barang_id"];
$value = $_POST["value"];

if(empty($value) || $value < 0 ){
 $value=1;
}

// nilai quantitynya
$keranjang[ $barang_id ]["quantity"]=$value;

$_SESSION["keranjang"]= $keranjang;
