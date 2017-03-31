<?php include 'header.php'; ?>
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
<?php include 'footer.php'; ?>
	
