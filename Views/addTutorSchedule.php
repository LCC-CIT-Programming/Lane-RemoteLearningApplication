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
	 
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

   </head>


<body>
<div class="title">
	  <div class="container text-center">
		<h1>Lane Community College CIT Lab Edit Profile</h1>
	  </div>
	</div>
	<div class="container-fluid" style="width: 500px">
	
	<form class="">
	<div class = "form-group">
	<button class="btn btn-success pull-right" style="border-radius: 50%;"><i class="fa fa-plus" aria-hidden="true"></i></button>
	
		<div class = "row">
			<div class = "col-md-4">
				<input type="date" style="width:100%" />
			</div>
			
			<div class = "col-md-3">
				<input type="time" style="width:100%"/>
			</div>
			<div class = "col-md-3">
				<input type="time" style="width:100%"/>
			</div>
		</div>
		</div>
		
		<button type="submit" class="btn btn-primary">Add</button>
		</form>
		
		
		<table class="table table-responsive table-condensed">
		<thead>
			<tr>
				<th>Day</th><th>Start time</th><th>End time</th>
			</tr>
		</thead>
		<tbody>
			<tr>
			<?php //foreach time in schedules table for this user, display... ?>
			</tr>
		</tbody>
		</table>
				
	</div>

	
</body>
<footer class="col-lg-12 container-fluid text-center" style="position: fixed; bottom: 0; width: 100%;">
		<div class="container">
			<h4>CITLab &nbsp;<small> Lane Community College &copy; 2017</small></h4>
		</div>
</footer>
</html>