<?php

$id = isset($_GET['id']) ? $_GET['id'] : false;

$kategori='';
$status='';
$button='Add';

if($id){
  $query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE kategori_id='$id'");
  $row= mysqli_fetch_assoc($query);
  $kategori=$row['kategori'];
  $status=$row['status'];
  $button='Update';
}


?>


<form action="<?= BASE_URL."module/kategori/action.php?id=$id";?>" method="post">

   <div class="element-form">
        
        <label>Kategori 
           <input type="text" name="kategori" value="<?= $kategori;?>">
        </label>
         <p> <b>Status</b> </p> 
            <input type="radio" name="status" value="on" <?php if($status == 'on'){echo "checked=true";} ?>>ON
            <input type="radio" name="status" value="off" <?php if($status == 'off'){echo "checked=true";} ?>> OFF  
            <br> <br>          
            <input type="submit" value="<?= $button ;?>" name="button">
        
     </div>




</form>