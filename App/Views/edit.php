 <?php include 'header.php'; ?>
<div class="container-fluid">
	<?php $user = $_SESSION['user'];?>
  	
	<div class="row">
		<div class="col-lg-12"><br /></div>
	</div>

	<div class="row">
      <!-- left column -->
      <div class="col-md-3">
	   <h2 class="text-center"><?php echo($user->getFirstName(). " " . $user->getLastName());?></h2>
        <div class="text-center">
          <img src="./Styles/smiley.png
		  " class="avatar img-circle" alt="avatar">
          <h6>Upload a different photo...</h6>
          <input type="file" class="form-control" style="display: block;">
		  </br>

        </div>
      </div>
      <!-- edit form column -->
      <div class="col-md-9 personal-info">


        <br />
		<form class="form-horizontal" method="post" action=".?=edit_profile" id="edit_form">
		<input type="hidden" name="action" value="edit_profile" />




          <div class="form-group">
            <label class="col-md-3 control-label">New Password:</label>
            <div class="col-md-8">
              <input class="form-control" id="newPwd1" name="newPwd1" type="password" value="">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-3 control-label">Re-enter Password:</label>
            <div class="col-md-8">
              <input class="form-control" id="newPwd2" name="newPwd2" type="password" value="">
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
<?php include 'footer.php'; ?>
