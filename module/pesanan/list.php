<?php

if($level == "superadmin"){
$queryPesanan = mysqli_query($koneksi, "SELECT pesanan.*, user.nama FROM pesanan JOIN user ON pesanan.user_id=user.user_id ORDER BY pesanan.tanggal_pemesanan DESC ");
}else{
   $queryPesanan = mysqli_query($koneksi, "SELECT pesanan.*, user.nama FROM pesanan JOIN user ON pesanan.user_id=user.user_id WHERE pesanan.user_id='$user_id' ORDER BY pesanan.tanggal_pemesanan DESC ");
}
if(mysqli_num_rows($queryPesanan)== 0){
   echo"<h3>Data Masih Kosong</h3>";
}else{
   echo"
   <table class='table-list'>
      <tr class='baris-title'>
         <th class='no'>Nomor Pesanan</th>
         <th class='kiri'>Status</th>
         <th class='kiri'>Nama</th>
         <th class='kiri'>Action</th>
      </tr>";

   
   while($row=mysqli_fetch_assoc($queryPesanan)){
      $adminbutton='';
      if($level == "superadmin"){
        $adminbutton= "<a class='tombol-action' href='".BASE_URL."index.php?page=my_profile&module=pesanan&action=status&pesanan_id=$row[pesanan_id]'>Update Status</a>"; 
      }
      $status=$row['status'];
      echo"
      <tr class='baris-title'>
         <td class='no'>$row[pesanan_id]</td>
         <td class='kiri'>$arrayStatusPesanan[$status]</td>
         <td class='kiri'>$row[nama]</td>
         <td class='kiri'>
         <a class='tombol-action' href='".BASE_URL."index.php?page=my_profile&module=pesanan&action=detail&pesanan_id=$row[pesanan_id]'>Detail Pesanan</a>
         $adminbutton
         </td>
      </tr>";


   }

   echo"</table>";
}

?>