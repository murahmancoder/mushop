<?php
   if($user_id){
      header('location:'.BASE_URL);
   }
   
?>



<div class="user-akses">

   <form action="<?= BASE_URL.'proses-register.php';?>" method="post">

   <?php
      $notif = isset($_GET['notif']) ? $_GET['notif'] : false;
      $nama = isset($_GET['nama']) ? $_GET['nama'] : false;
      $email = isset($_GET['email']) ? $_GET['email'] : false;
      $notelp = isset($_GET['notelp']) ? $_GET['notelp'] : false;
      $alamat = isset($_GET['alamat']) ? $_GET['alamat'] : false;

      if ($notif == 'require'){
         echo '<div class="notif"> Maaf ada yang kosong Data harus lengkap </div>';
      }else if($notif == 'password'){
         echo '<div class="notif"> Maaf Password tidak sama </div>';
      }else if($notif == 'email'){
         echo '<div class="notif"> Maaf Email sudah digunakan </div>';
      }
   ?>

      <div class="element-form">
         <label>Nama 
            <input type="text" name="nama" autocomplete="off" value="<?= $nama;?>">
         </label>
         <label>Email 
            <input type="text" name="email" value="<?= $email;?>">
         </label>
         <label>No Telepon 
            <input type="text" name="notelp" value="<?= $notelp;?>">
         </label>
         <label>Alamat 
            <textarea name="alamat"><?= $alamat;?></textarea>
         </label>
         <label>Password
            <input type="password" name="password">
         </label>
         <label>Re-Password 
            <input type="password" name="re_password">
         </label>
         
       
            <input type="submit" value="Register">
         
        
         
      </div>


   </form>

</div>