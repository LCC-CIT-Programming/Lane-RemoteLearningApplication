<!DOCTYPE html>
<html lang="en">

<head>
  <title>LCC CIT Lab Student Home</title>

  <link rel="stylesheet" type="text/css"
          href="./Styles/main.css">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>


<div class="title">
  <div class="container text-center">
    <h1>Student Profile</h1>
  </div>
</div>

<body style='margin-bottom: 50px;'>
<!--Nav Bar -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
	<div class="navbar-header">
	  <a class="navbar-brand" href="#">CIT Lab</a>
	</div>
	<div class="collapse navbar-collapse" id="navbar">
	  <ul class="nav navbar-nav">
		<li class="active"><a href="#">Home</a></li>
		<li><a href="schedule.php">Schedule</a></li>
		<li><a href="index.php?action=ask">Questions</a></li>
	  </ul>
	  <ul class="nav navbar-nav navbar-right">
		<li><a href="#"><span class="glyphicon glyphicon-envelope"><span class="badge">1</span></span></a></li>
		<li><a href="index.php"><span ></span>Logout</a></li>
	  </ul>
	</div>
  </div>
</nav>

<h1>Hello Bob!</h1>
<h3>Your current email is: bob@fake.com </h3>
<form action="profile" method="post">
  <div class="form-group input-lg col-xs-4">
  <label for="email">Email:</label>
  <input type="text" class="form-control input-lg" id="email">


  <label for="pwd">Password:</label>
  <input type="password" class="form-control input-lg" id="pwd">

    <label for="confirmpwd">Confirm Password:</label>
    <input type="password" class="form-control input-lg"id="confirmpwd">
    <br/>
    <input class="btn-lg" type="submit" value="Submit">
</div>

</form>





</body>
<footer class="container-fluid text-center" style="position: fixed; bottom: 0; width: 100%;">
		<div class="container">
			<h4>CITLab &nbsp;<small> Lane Community College &copy; 2017</small></h4
		</div>
</footer>
</html>
