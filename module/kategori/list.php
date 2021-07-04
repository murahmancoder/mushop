<div id="frame-tambah">
   <a href="<?= BASE_URL.'index.php?page=my_profile&module=kategori&action=form';?>" class="tombol-action">
      + Tambah Kategori
   </a>
</div>


<?php
   $pagination = isset($_GET['pagination']) ? $_GET['pagination'] : 1;
   $data_per_halaman = 3;
   $mulai_dari = ($pagination-1)*$data_per_halaman;


   // jika sudah ada data maka ini bakal ditampilkan
   $queryKategori = mysqli_query($koneksi,"SELECT * FROM kategori LIMIT $mulai_dari, $data_per_halaman");

   if(mysqli_num_rows($queryKategori)==TRUE){
      echo "
         <table class='table-list'>
            <tr class='baris-title'>
               <th class='no'>No</th>
               <th class='kiri'>Kategori</th>
               <th class='tengah'>Status</th>
               <th class='tengah'>Action</th>
            </tr>";

         $no=1 + $mulai_dari;
         while($row= mysqli_fetch_assoc($queryKategori)){
            echo
            "<tr>
               <td class='no'>$no</td>
               <td class='kiri'>$row[kategori]</td>
               <td class='tengah'>$row[status]</td>
               <td class='tengah'>
               <a class='tombol-action' href='".BASE_URL."index.php?page=my_profile&module=kategori&action=form&id=$row[kategori_id]'>Edit</a>
               <a class='tombol-action' href='".BASE_URL."module/kategori/action.php?button=Delete&id=$row[kategori_id]'>Hapus</a>
               </td>
            </tr>";
            $no++;
         }
         echo"</table>";

         $queryHitungKategori= mysqli_query($koneksi,"SELECT * FROM kategori");
         pagination($queryHitungKategori,$data_per_halaman,$pagination,"index.php?page=my_profile&module=kategori&action=list");
         
         //Pagination Yang belum di function
         // $total_data=mysqli_num_rows($queryHitungKategori);
         // $total_halaman= ceil($total_data/$data_per_halaman);

         // echo"<ul class='pagination'>";
         // for($i=1; $i<=$total_halaman; $i++){
         //    if($pagination == $i){
         //    echo "<li><a href='".BASE_URL."index.php?page=my_profile&module=kategori&action=list&pagination=$i' class='active'>$i</a></li>";
         //    }else{
         //    echo "<li><a href='".BASE_URL."index.php?page=my_profile&module=kategori&action=list&pagination=$i'>$i</a></li>";
         //    }
         // }
         // echo"</ul>";

         
   }else{
      echo"TAbel KOSONG";
   }


