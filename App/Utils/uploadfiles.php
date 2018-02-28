<?php

	function uploadPicture($doc_root, $picture_path, $user, &$errors)
	{
		if(isset($_FILES['savePicture'])) {

			$user_picture_filename = $user->getImageFilename();
			$user_picture_path = $picture_path . $user_picture_filename;
			$full_picture_path = $doc_root . $user_picture_path;

			$maxsize    = 2097152;
			$acceptable = array(
				'image/jpeg',
				'image/jpg',
				'image/gif',
				'image/png'
			);

			if(($_FILES['savePicture']['size'] >= $maxsize) || ($_FILES['savePicture']['size'] == 0)) {
				$errors[] = 'File too large. File must be less than 2 megabytes.';
			}

			if(!(in_array($_FILES['savePicture']['type'], $acceptable)) && !(empty($_FILES["savePicture"]['type']))) {
				$errors[] = 'Invalid file type. Only JPG, GIF and PNG types are accepted.';
			}

			if(count($errors) === 0) {
				if (is_uploaded_file($_FILES['savePicture']['tmp_name'])) {
					//echo ("uploaded");
					if (move_uploaded_file($_FILES['savePicture']['tmp_name'], $full_picture_path)) {
						//echo ("saved");
						return true;
					}
					else {
						$errors[] = 'A technical error has occurred.  Your file was not uploaded but could not be saved.' ;
						//print_r($errors);
						return false;
					}
				} 
				else {
					$errors[] = 'A technical error has occurred.  Your file was not uploaded.' ;
					//print_r($errors);
					return false;
				}
			}	
			else {
				return false;
			}
		}
	}
	
?>