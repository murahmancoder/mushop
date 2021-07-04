<?php

$pesanan_id= $_GET["pesanan_id"];

?>

<table>

   <form action="<?= BASE_URL."module/pesanan/action.php?pesanan_id=$pesanan_id";?>" method="post">

   <div class="element-form">
      <label>
         Nama Account :
         <input type="text" name="nama_account">
      </label>
      <label>
         Nomor Rekening :
         <input type="text" name="nomor_rekening">
      </label>
      <label>
         Tanggal Transfer (format: yy-mm-dd)
         <input type="text" name="tanggal_transfer">
      </label>

      <input type="submit" value="konfirmasi" name="button">
      </div>
   </form>

</table>