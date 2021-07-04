<?php

$id = isset($_GET['id']) ? $_GET['id'] : false;

$nama_barang='';
$kategori_id='';
$harga='';
$stok='';
$gambar='';
$spesifikasi='';
$status='';
$keterangan_gambar='';
$button='Add';

if($id){
  $query = mysqli_query($koneksi, "SELECT * FROM barang WHERE barang_id='$id'");
  $row= mysqli_fetch_assoc($query);
  $nama_barang=$row['nama_barang'];
  $harga=$row['harga'];
  $stok=$row['stok'];
  $spesifikasi=$row['spesifikasi'];
  $kategori_id=$row['kategori_id'];
  $gambar=$row['gambar'];
  $status=$row['status'];
  $button='Update';

  $keterangan_gambar='<b>( klik untuk mengganti gambar ) </b>';
  $gambar =  "<img src='".BASE_URL."images/barang/$gambar' style='width:200px;vertical-align:middle;' >";
}


?>

<script src="<?=BASE_URL.'/js/ckeditor/ckeditor.js'; ?>"></script>

<form action="<?= BASE_URL."module/barang/action.php?id=$id";?>" method="post" enctype="multipart/form-data">

   <div class="element-form">
        
        <label>Kategori 
           <select name="kategori_id">
               <?php
                  $query = mysqli_query($koneksi, "SELECT kategori_id, kategori FROM kategori WHERE status='on' ORDER BY kategori ASC");
                  while($row=mysqli_fetch_assoc($query)){
                     if($kategori_id == $row['kategori_id']){
                        echo"<option value='$row[kategori_id]' selected='true'>$row[kategori]</option>";
                     }else{
                     echo"<option value='$row[kategori_id]'>$row[kategori]</option>";
                     }
                  }
               ?>  
           </select>
        </label>

         <label>Nama Barang
            <input type="text" name="nama_barang" value="<?= $nama_barang; ?>">
         </label>

         <label>Harga
            <input type="text" name="harga" value="<?= $harga; ?>">
         </label>
         
         <label>Spesifikasi
            <textarea name="spesifikasi" id="editor"><?= $spesifikasi; ?></textarea>
         </label>
         <label> <b>Stok</b>
            <input type="text" name="stok" value="<?= $stok; ?>">
         </label>
         <label>Gambar Produk
            <?= $keterangan_gambar; ?>
            <input type="file" name="gambar">
            <?=$gambar;?>
         </label>

         <p> <b>Status</b> </p> 
            <input type="radio" name="status" value="on" <?php if($status == 'on'){echo "checked=true";} ?>>ON
            <input type="radio" name="status" value="off" <?php if($status == 'off'){echo "checked=true";} ?>> OFF  
            <br> <br>          
            <input type="submit" value="<?= $button ;?>" name="button">
        
     </div>

</form>

<script>
   CKEDITOR.replace("editor");
</script>