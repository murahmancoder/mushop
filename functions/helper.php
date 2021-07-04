<?php

define("BASE_URL","http://localhost/mushop/");

$arrayStatusPesanan=["Menunggu Pembayaran", "pembayaran sedang di Validasi", "Lunas", "Pembayaran Di tolak"];

function rupiah($nilai){
   return $string = "Rp. ".number_format($nilai);
}

function kategori($kategori_id=false){
   global $koneksi;
   $string = "<div id='menu-kategori'>
      <ul>";
         
            $queryKategori=mysqli_query($koneksi, "SELECT * FROM kategori WHERE status='on'");
            while($row=mysqli_fetch_assoc($queryKategori)){
               if($kategori_id == $row['kategori_id'] ){
                  $string.="<li><a href='".BASE_URL."index.php?kategori_id=$row[kategori_id]' class='active' >$row[kategori]</a></li>";
               }else{
                  $string.="<li><a href='".BASE_URL."index.php?kategori_id=$row[kategori_id]'>$row[kategori]</a></li>";
               }
            }
       
     $string .=" </ul>
   </div>";

   return $string;
}

function pagination($query, $data_per_halaman, $pagination, $url ){
   $total_data=mysqli_num_rows($query);
   $total_halaman= ceil($total_data/$data_per_halaman);

   $batasPosisiNomor =3;
   $batasJumlahHalaman =5;
   $mulaiPagination =1;
   $batasAkhirPagination=$total_halaman;

   echo"<ul class='pagination'>";
   
   if($pagination > 1){
      $prev=$pagination-1;
      echo "<li><a href='".BASE_URL."$url&pagination=$prev' ><< Prev</a></li>";
   }

   if($total_halaman >= $batasJumlahHalaman){
      if($pagination > $batasPosisiNomor){
         $mulaiPagination=$pagination - ($batasPosisiNomor-1);
      }
      $batasAkhirPagination= ($mulaiPagination-1) + $batasJumlahHalaman;
      if($batasAkhirPagination > $total_halaman){
         $batasAkhirPagination=$total_halaman;
      }
   }

   for($i=$mulaiPagination; $i<=$batasAkhirPagination; $i++){
      if($pagination == $i){
      echo "<li><a href='".BASE_URL."$url&pagination=$i' class='active'>$i</a></li>";
      }else{
      echo "<li><a href='".BASE_URL."$url&pagination=$i'>$i</a></li>";
      }
   }

   if($pagination < $total_halaman){
      $next=$pagination+1;
      echo "<li><a href='".BASE_URL."$url&pagination=$next' >>> Next</a></li>";
   }
   echo"</ul>";

}


function admin_only($module, $level){
   if($level != "superadmin"){
      $adminPages = ["kategori","barang", "kota", "user", "banner"];
      if(in_array($module, $adminPages)){
         header("Location:".BASE_URL);
      }
   }
}