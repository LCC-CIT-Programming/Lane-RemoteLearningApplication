<!-- ADD VALLIDATION!!-->
<?php 
/*
$lnumber = "";
$password = "";
$lnumErr = "";
$passErr = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(empty($_POST["lnumber"])){
		$lnumErr = "Please enter your L-Number.";
	}
	else{
		$lnumber = val_input($_POST["lnumber"]);
		if(!preg_match())
	}
	if(empty($_POST["password"])){
		$passErr = "Please enter your password.";
	}
	else{
		$password = val_input($_POST["password"]);
	}
}

function val_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
*/
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>LCC CIT Lab</title>
  
  <link rel="stylesheet" href="./style/login.css">
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  
<body>
	<div class="container">
		<div class="row">
		  <div class="col-sm-3"></div>
		  <div class="col-sm-6" id="login">
			<div class="login-screen">
				<div class="greeting">
					<p>Welcome to LCC CIT Lab <br />
					Please Login
					</p>
				</div>

				<form method="post" action=".?action=login">
				<div class="login-form">
				
					<div class="control-group">
					<label class="label-group" >Username</label><br>
					<input type="text" class="login-field" value="" name="lnumber" required autofocus>
							
					<label class="login-field-icon fui-user" for="login-name"></label>
					
					</div>

					<div class="control-group">
					<label class="label-group">Password</label><br>
					<input type="text" class="login-field" value="" name="password" required>
					<span class="error">*</span>
					<input type="hidden" name="error"
							   value="<?php $loginError;?>">
					<label class="login-field-icon fui-lock" for="login-pass"></label>
					</div>
					
					<br />
					<div class="form-actions">
					<button type="submit" class="btn btn-primary btn-lg">Submit</button>
					</div>
					<br />
					<input  type="checkbox" name="isTutor" value="tutor" id="tutChck">Are you a tutor?
					
					
				</div>
				</form>
		    </div>
		  </div>
		  <div class="col-sm-3"></div>
		</div>
	</div>


</body>
