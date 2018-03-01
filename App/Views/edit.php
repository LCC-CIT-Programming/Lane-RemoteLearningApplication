<?php include 'header.php'; ?>
<div class="container-fluid">
	<?php $user = $_SESSION['user'];?>
  	
	<div class="row">
		<div class="col-lg-12"><br /></div>
	</div>

	<div class="row">
      <!-- left column -->
      <div class="col-md-3">
		<div class="text-center">
      	  	<!-- user picture -->
			<?php
				$user_picture_filename = $user->getImageFilename();
				$user_picture_path = $picture_path . $user_picture_filename;
				$full_picture_path = $doc_root . $user_picture_path;
				$default_image = './Styles/smiley.png';
				if (file_exists($full_picture_path))
					echo "<div class='big_smiley' style='background-image:url($user_picture_path)'></div>";
				else
					echo "<div class='big_smiley' style='background-image:url($default_image)'></div>";

			?>
      	</div>
        <div class="text-center">
        	<!-- upload picture form -->
          	<form action="." method="post" enctype="multipart/form-data">
          		<br />
				<input type="file" id="savePicture" name="savePicture" required class="form-control" style="display: block;">
				<input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
				<br />
				<button type="save" class="btn btn-primary" id="saveProfile" name="upload">Upload (New) Photo</button>
				<input type="hidden" name="action" value="upload_picture" />
		  	</form>
		  </br>
        </div>
		<div>
			<span class="success pull-left"  style="color:red; font-weight:bold">
				<?php 
					foreach ($uploadErrors as $uploadError)
						echo "<p>$uploadError</p>";
				?>
			</span>
		</div>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
	   	<h2 class="text-center"><?php echo($user->getFirstName(). " " . $user->getLastName());?></h2>
		<form class="form-horizontal" method="post" action="." id="edit_form">
			<input type="hidden" name="action" value="edit_profile" />

			<div class="form-group">
				<label for='email' class="col-md-3 control-label">Email:</label>
				<div class="col-md-8">
					<input class="form-control" id="newEmail" name="newEmail" type="email" 
						value='<?php echo $user->getEmail(); ?>'>
				</div>
			</div>
			<div class="form-group">
				<label for='bio' class="col-md-3 control-label">Short Bio:</label>
				<div class="col-md-8">
					<input class="form-control" id="newBio" name="newBio" type="text" 
						value='<?php echo $user->getBio(); ?>'>
				</div>
			</div>
			
			<?php 
				if ($user instanceof Student) {
					echo '<div class="form-group">';
					echo 	'<label for="studentmajor" class="col-md-3 control-label">Major:</label>';
					echo 	'<div class="col-md-8">';
		        	echo 		"<select class='form-control' id='newStudentMajor' name='newStudentMajor'>";
					$majors = $_SESSION['majors'];
		        	foreach ($majors as $major) {
		        		if ($user->getMajorId() == $major->getMajorId())
		           	 		echo 	'<option value = "' . $major->getMajorId().'" selected >' . $major->getMajorName() . '</option>';		        		
		        		else
		           	 		echo 	'<option value = "' . $major->getMajorId().'" >' . $major->getMajorName() . '</option>';
		        	}
		        	echo 		"</select>";
					echo 	'</div>';
					echo '</div>';
				}
			?>
			
			<?php 
				if ($user instanceof Tutor) {
					echo '<div class="form-group">';
					echo 	'<label for="tutorbio" class="col-md-3 control-label">Tutoring Bio:</label>';
					echo 	'<div class="col-md-8">';
					echo 		'<input class="form-control" id="newTutorBio" name="newTutorBio" type="text" value="' .
								$user->getTutorBio() .'">';
					echo 	'</div>';
					echo '</div>';
				}
			?>

			<div class="form-group">
				<label class="col-md-3 control-label"></label>
				<div class="col-md-8 form-actions">
					<button type="save" class="btn btn-primary" id="saveProfile" name="saveProfile">Save Changes</button>
				    <span></span>
					<a href="?action=home"><input id="canelBtn" class="btn btn-default" type="button" value="Cancel"></a>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-3 control-label"></label>
				<div class="col-md-8">
					<span class="success pull-left"  style="color:green; font-weight:bold"><?php echo $profileSuccess ?></span>
					<span class="success pull-left"  style="color:red; font-weight:bold">
					<?php 
						foreach ($profileErrors as $profileError)
							echo "<p>$profileError</p>";
					?>
					</span>
				</div>
			</div>

        </form>
      </div>
  </div>
</div>
<?php include 'footer.php'; ?>
