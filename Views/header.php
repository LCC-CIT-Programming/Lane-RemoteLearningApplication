<!-- The header includes body tag and nav... include on all pages and begin page with <div class= "container-fluid">-->
<!DOCTYPE html>
<html lang="en">

<head>
  <title>LCC CIT Lab Student Home</title>

  <link rel="stylesheet" type="text/css" href="./Styles/main.css">
  <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>


<div class="title">
  <div class="container text-center">
    <h1>Lane Community College CIT Lab</h1>
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
		<li><a href="?action=home">Home</a></li>

		<li><a href="?action=schedule">Schedule</a></li>
	<?php
    $role = $_SESSION['role'];
    if ($role == 'student') {
        echo "<li><a href='?action=ask'>Questions</a></li>";
    } elseif ($role == 'tutor') {
        echo "<li><a href='?action=edit_schedule'>Edit My Schedule</a></li>";
    }
    ?>
	  </ul>
	  <ul class="nav navbar-nav navbar-right">
		<li><a href="?action=logout"><span ></span>Logout</a></li>
	  </ul>
	</div>
  </div>
</nav>
