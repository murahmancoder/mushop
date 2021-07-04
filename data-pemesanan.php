<?php

// dibuat hanya untuk logim
if($user_id == false){
   $_SESSION["proses-pesanan"] = true;
   header("location:".BASE_URL."index.php?page=login");
   exit;
}


?>




<div class="main">

   <div id="frame-pengiriman">
      <h3 class="label-data">Alamat Pengiriman Barang</h3>
      
      <div id="form-kirim">
      <form action="<?=BASE_URL."proses-pemesanan.php";?>" method="post">
         <div class="element-form">
         
            <label>Nama Penerima 
               <input type="text" name="nama_penerima">
            </label>
            <label>Telepon
               <input type="text" name="telepon">
            </label>
            <label >Alamat Pengiriman
               <textarea name="alamat"></textarea>
            </label>
            <label>Kota
               <select name="kota">
                  <?php 
                     $query=mysqli_query($koneksi,"SELECT * FROM kota");
                     while($rowKota=mysqli_fetch_assoc($query)){
                        echo "<option value='$rowKota[kota_id]'>$rowKota[kota] (".rupiah($rowKota['tarif']).")</option>";
                     }
                  ?>
               </select>
            </label>
            <input type="submit" value="kirim">

         </div>
      </form>
      </div>
   </div>


   <div id="frame-order">
      <h3 class="label-data">Detail Order</h3>

      <div id="detail">
      <table class="table-list">
         <tr class="baris-title">
            <th>Nama Barang</th>
            <th>Qty</th>
            <th>Total</th>
         </tr>

         <?php
         $subtotal=0;
         // disession array bukan didatabase
            foreach($keranjang as $key => $value){
               $barang_id=$key;

               $nama_barang = $value["nama_barang"];
               $quantity = $value["quantity"];
               $harga = $value["harga"];

               $total = $harga * $quantity;
               $subtotal+=$total;
               echo"
               <tr>
                  <td class='kiri'>$nama_barang</td>
                  <td class='tengah'>$quantity</td>
                  <td class='kanan'>".rupiah($total)."</td>
               </tr>";
            }   
               echo"
               <tr class='baris-title'>
                  <td colspan='2' class='kanan'>Sub Total</td>
                  <td class='kanan'>".rupiah($subtotal)."</td>
               </tr>";

               
            
         ?>
         
      </table>
      </div>
   </div>


</div>

