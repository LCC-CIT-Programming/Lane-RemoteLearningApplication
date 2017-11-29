<?php
	public function upload_Picture(){
		$success = "";
		$passError = "";
		$target_dir = "Profile_Pics/";
		$target_file = $target_dir . basename($_FILES["savePicture"]["name"]);
		$uploadGood = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		if(isset($_POST["submit"])){
			$check = getimagesize($_FILES["savePicture"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadGood = 1;
			} else {
				echo "File is not an image.";
				$uploadGood = 0;
			}
		}
			
		// Check if file already exists
		/*if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadGood = 0;
		}*/
			
		 // Check file size
		if ($_FILES["savePicture"]["size"] > 200000) { //200kb
			echo "Sorry, your file is too large. Maximum file size is 200KB";
			$uploadGood = 0;
		}
			
		// Allow certain file formats
		/*if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {*/
			//echo "Sorry, only PNG files are allowed.";
			//$uploadGood = 0;
		//}
			
		// Check if $uploadGood is set to 0 by an error
		if ($uploadGood == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["savePicture"]["tmp_name"], $target_file)) { 
				echo "The file ". basename( $_FILES["savePicture"]["name"]). " has been uploaded.";
				$success = "The file ". basename( $_FILES["savePicture"]["name"]). " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
	}
?>