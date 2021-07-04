<?php
   if($totalBarang == 0){
      echo "<h3>Saat ini belum ada apapun dikeranjang anda</h3>";
   }else{
      echo"
      <table class='table-list'>
         <tr class='baris-title'>
            <th class='tengah'>No</th>
            <th class='kiri'>Image</th>
            <th class='kiri'>Nama Barang</th>
            <th class='tengah'>Qty</th>
            <th class='kanan'>Harga</th>
            <th class='kanan'>Total</th>
         </tr>";
         $no=1;
         $subtotal=0;
         
         // session array keranjang diindex diolah disini
         foreach($keranjang as $key => $value) {
               $barang_id=$key;
               $nama_barang=$value["nama_barang"];
               $harga=$value["harga"];
               $gambar=$value["gambar"];
               $quantity=$value["quantity"];
               $total=$quantity*$harga;
               $subtotal+=$total;
               echo"
               <tr class='baris-title'>
                  <td class='tengah'>$no</td>
                  <td class='kiri'><img src='".BASE_URL."images/barang/$gambar' height='100px'></td>
                  <td class='kiri'>$nama_barang</td>
                  <td class='tengah'><input type='number' min='1' name='$barang_id' value='$quantity' class='update-quantity'></td>
                  <td class='kanan'>".rupiah($harga)."</td>
                  <td class='kanan hapus-item'>".rupiah($total)."<a href='".BASE_URL."hapus-item.php?barang_id=$barang_id'>X</a></td>
               </tr>";
               $no++;
         }
         echo"
         <tr class='baris-title'>
            <td colspan='5' class='kanan'>Sub Total</td>
            <td class='kanan'>".rupiah($subtotal)."</td>
         </tr>";
         
      echo"</table>";
   }

   echo"
   <div id='frame-button-keranjang'>
      <a id='belanja' href='".BASE_URL."index.php'>< Lanjut Belanja</a>
      <a id= 'pemesanan' href='".BASE_URL."index.php?page=data-pemesanan'>Lanjut Pemesanan ></a>
   </div>";

?>

<script>

$(".update-quantity").on("input", function(e){
   var barang_id = $(this).attr("name");
   var value = $(this).val();
   $.ajax({
      method:"POST",
      url:"update-keranjang.php",
      data:"barang_id="+barang_id+"&value="+value 
   })
   .done(function(data){  
      location.reload();
   });
});
</script>