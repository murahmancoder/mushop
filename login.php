<?php

if($user_id){
   header('location:'.BASE_URL);
}

?>



<div class="user-akses">

   <form action="<?= BASE_URL.'proses-login.php';?>" method="post">

   <?php
      $notif = isset($_GET['notif']) ? $_GET['notif'] : false;
   
      if ($notif == 'true'){
         echo '<div class="notif"> Maaf Data Salah</div>';
      }
   ?>

      <div class="element-form">
        
         <label>Email 
            <input type="text" name="email">
         </label>
         <label>Password
            <input type="password" name="password">
         </label>
            <input type="submit" value="Login">

      </div>
   </form>

</div>