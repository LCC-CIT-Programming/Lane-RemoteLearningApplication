 <!DOCTYPE html>
<html lang="en">
  <head>
    <title>LCC CIT Lab Student Profile Edit</title>

	  <link rel="stylesheet" type="text/css"
			  href="./Styles/main.css">

	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

   </head>


<body>
<div class="container-fluid">
	<?php $user = $_SESSION['user'];?>
  	<div class="title">
	  <div class="container text-center">
		<h1>Lane Community College CIT Lab Edit Profile</h1>
	  </div>
	</div>
	
	<div class="row">
		<div class="col-lg-12"><br /></div>
	</div>
	
	<div class="row">
      <!-- left column -->
      <div class="col-md-3">
	   <h2 class="text-center"><?php echo ($user->getFirstName(). " " . $user->getLastName());?></h2>   
        <div class="text-center">
          <img src="./Styles/smiley.png
		  " class="avatar img-circle" alt="avatar">
          <h6>Upload a different photo...</h6>
          <input type="file" class="form-control" style="display: block;">
		  </br>
		
              <span></span>
				<a href="?action=edit_Schedule"><input id="editSchedule" name="editSchedule" class="btn btn-default" type="button" value="Edit Schedule"></a>

		  
        </div>
      </div> 	  
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
	
          
        <br />
		<form class="form-horizontal" method="post" action=".?=edit_profile" id="edit_form">
		<input type="hidden" name="action" value="edit_TutProfile" />
		
		
          <div class="form-group">
		  <label class="col-md-3 control-label">Email:</label>
			<div class="col-md-8">
				<input class="form-control" id="email" name="email" type="text" value="<?php echo($user->getEmail());?>" required>
			</div>
          </div>
		  
          <div class="form-group">
            <label class="col-md-3 control-label">New Password:</label>
            <div class="col-md-8">
              <input class="form-control" id="newPwd1" name="newPwd1" type="password" value="">
            </div>
          </div>
		  
          <div class="form-group">
            <label class="col-md-3 control-label">New password:</label>
            <div class="col-md-8">
              <input class="form-control" id="newPwd2" name="newPwd2" type="password" value="">
            </div>
          </div>
		  
		  <div class="form-group">
            <label class="col-md-3 control-label">Summary of Skills:</label>
            <div class="col-md-8">
              <textarea class="form-control" rows="5" id="summary" name="summary"></textarea>
            </div>
          </div>
		 
		  
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8 form-actions">	  
				<button type="save" class="btn btn-primary" id="saveProfile" name="saveProfile">Save Changes</button>
              <span></span>
				<a href="?action=home"><input id="canelBtn" class="btn btn-default" type="button" value="Cancel"></a>
            </div>
          </div>
		   <div class="col-md-6">
				<span class="success pull-right"  style="color:green; font-weight:bold"><?php echo $success ?></span>
				<span class="success pull-right"  style="color:red; font-weight:bold"><?php echo $passError ?></span>
			</div>
		  
        </form>
      </div>
  </div>
</div>

</body>
<footer class="container-fluid text-center" style="position: fixed; bottom: 0; width: 100%;">
		<div class="container">
			<h4>CITLab &nbsp;<small> Lane Community College &copy; 2017</small></h4
		</div>
</footer>
</html>