<?php

$pesanan_id = $_GET["pesanan_id"];
$query= mysqli_query($koneksi, "SELECT status FROM pesanan WHERE pesanan_id='$pesanan_id'");
$row= mysqli_fetch_assoc($query);
$status=$row['status'];

?>

<form action="<?=BASE_URL."module/pesanan/action.php?pesanan_id=$pesanan_id";?>" method="post">
   <div class="element-form">
      <label>Nomor Faktur(ID)
         <input type="text" name="pesanan_id" value="<?=$pesanan_id;?>" readonly="true">
      </label>
      <label>Status
         <select name="status">
            <?php
               foreach($arrayStatusPesanan as $key => $value){
                  if($status == $key){
                  echo"<option value='$key' selected='true'>$value</option>";
                  }else{
                     echo"<option value='$key'>$value</option>";
                  }
               }
            ?>
         </select>
      </label>

      <input class="tombol_action" type="submit" name="button" value="Edit Status">
   </div>
</form>