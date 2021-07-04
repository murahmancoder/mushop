<?php

$pesanan_id = $_GET["pesanan_id"];

$query = mysqli_query($koneksi, "SELECT pesanan.nama_penerima, pesanan.nomor_telepon, pesanan.alamat, pesanan.tanggal_pemesanan, user.nama, kota.kota, kota.tarif FROM pesanan JOIN user ON pesanan.user_id=user.user_id JOIN kota ON kota.kota_id=pesanan.kota_id WHERE pesanan.pesanan_id='$pesanan_id'");

$row=mysqli_fetch_assoc($query);

// dari db pesanan
$tanggal_pesanan=$row["tanggal_pemesanan"];
$nama_penerima=$row["nama_penerima"];
$nomor_telepon =$row["nomor_telepon"];
$alamat=$row["alamat"];

// dari db user
$nama=$row["nama"];

// dari db kota
$tarif=$row["tarif"];
$kota= $row["kota"];

?>

<div id="frame-faktur">

   <h3>Detail Pesanan</h3>
   <hr>

   <table>
      <tr>
         <td>Nomor Faktur</td>
         <td>:</td>
         <td><?=$pesanan_id;?></td>
      </tr>
      <tr>
         <td>Nama Pemesanan </td>
         <td>:</td>
         <td><?=$nama;?></td>
      </tr>
      <tr>
         <td>Nama Penerima</td>
         <td>:</td>
         <td><?=$nama_penerima;?></td>
      </tr>
      <tr>
         <td>Alamat</td>
         <td>:</td>
         <td><?=$alamat;?></td>
      </tr>
      <tr>
         <td>Telepon</td>
         <td>:</td>
         <td><?=$nomor_telepon;?></td>
      </tr>
      <tr>
         <td>Tanggal Pemesanan</td>
         <td>:</td>
         <td><?=$tanggal_pesanan;?></td>
      </tr>
      
   </table>
</div>

   <table class="table-list">
      <tr class="baris-title">
         <th class="no">No</th>
         <th class="kiri">Nama Barang</th>
         <th class="tengah">Qty</th>
         <th class="kanan">Harga Satuan</th>
         <th class="kanan">Total</th>
      </tr>

      <?php

         $queryDetail=mysqli_query($koneksi,"SELECT pesanan_detail.*, barang.nama_barang FROM pesanan_detail JOIN barang ON pesanan_detail.barang_id=barang.barang_id WHERE pesanan_detail.pesanan_id='$pesanan_id'");
         
         $no=1;
         $subtotal=0;

         while($rowDetail=mysqli_fetch_assoc($queryDetail)){
            $total = $rowDetail["harga"] * $rowDetail["quantity"];
            $subtotal += $total; 
           echo
           "<tr>
               <td class='no'>$no</td>
               <td class='kiri'>$rowDetail[nama_barang]</td>
               <td class='tengah'>$rowDetail[quantity]</td>
               <td class='kanan'>".rupiah($rowDetail["harga"])."</td>
               <td class='kanan'>".rupiah($total)."</td>
            </tr>";
            $no++;
         }
         
         $subtotal +=$tarif;
      ?>

      <tr>
         <td class="kanan" colspan="4">Biaya Pengiriman</td>
         <td class="kanan"><?=rupiah($tarif);?></td>
      </tr>
      <tr>
         <td class="kanan" colspan="4">Sub Total</td>
         <td class="kanan"><?=rupiah($subtotal);?></td>
      </tr>
   </table>

   <div id="frame-konfirmasi">
      <p>Silahkan Lakukan Pembayaran ke Bank ABC <br>
         Nomor Accont : 00000-98989 <br>
         Silahkan konfirmasi pembayaran disini <a href="<?= BASE_URL."index.php?page=my_profile&module=pesanan&action=konfirmasi_pembayaran&pesanan_id=$pesanan_id"?>">Disini.</a>
      </p>
   </div>