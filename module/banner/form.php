<?php
       
    $banner_id = isset($_GET['banner_id']) ? $_GET['banner_id'] : "";
       
    $banner = "";
    $link = "";
    $gambar = "";
	 $keterangan_gambar = "";
    $status = "";
       
    $button = "Add";
       
    if($banner_id != "")
    {
        $button = "Update";
		
        $queryBanner = mysqli_query($koneksi, "SELECT * FROM banner WHERE banner_id='$banner_id'");
        $row=mysqli_fetch_array($queryBanner);
           
			$banner = $row["banner"];
			$link = $row["link"];
			$gambar = "<img src='". BASE_URL."images/slide/$row[gambar]' style='width: 200px;vertical-align: middle;' />";
			$keterangan_gambar = "(klik 'Pilih Gambar' hanya jika tidak ingin mengganti gambar)";
			$status = $row["status"];
    }   
?>

<form action="<?php echo BASE_URL."module/banner/action.php?banner_id=$banner_id"?>" method="post" enctype="multipart/form-data">
	
	<div class="element-form">
		<label>Banner	
			<input type="text" name="banner" value="<?php echo $banner; ?>" />
	 	</label>

		<label>Link	
			<input type="text" name="link" value="<?php echo $link; ?>" />
	   </label>

		<label>Gambar <?php echo $keterangan_gambar; ?>	
			<input type="file" name="file" /><?php echo $gambar; ?>
	   </label>

		<label>Status</label>	
		
			<input type="radio" value="on" name="status" <?php if($status == "on"){ echo "checked"; } ?> /> On
			<input type="radio" value="off" name="status" <?php if($status == "off"){ echo "checked"; } ?> /> Off		
	   	<br><br>
		<input type="submit" name="button" value="<?php echo $button; ?>" class="submit-my-profile" />
	</div>	
</form>