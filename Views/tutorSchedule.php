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
<!--
	<?php 
	//$user = $_SESSION['user'];
	?>
	-->

  	<div class="title">
	  <div class="container text-center">
		<h1>Lane Community College CIT Lab Edit Profile</h1>
	  </div>
	</div>
	
	<div class="row">
		<div class="col-lg-12"><br /></div>
	</div>
	
	
	<div class="col-lg-2"></div>
	<div class="col-lg-8">
	
	<form class="form-horizontal" method="post" action=".?=save_Schedule" id="edit_form">
	<input type="hidden" name="action" value="save_Schedule" />
		<div class="table-responsive">
		<table class="table table-bordered">
        <thead class="th_tutSchedule" >
			<tr>
				<td>Sunday</td><td>Monday</td><td>Tuesday</td><td>Wednesday</td><td>Thursday</td><td>Friday</td><td>Saturday</td>
			</tr>
		</thead>
			<tr> <!-- deal with possible 2 shifts-->
				
				<?php 
					$am = "am";
					$pm = "pm";
					$days = array('Sun','Mon', 'Tue', 'Wed', 'Thr', 'Fri', 'Sat');
					
					for ($d =0; $d <= 6; $d++){
						echo '<td>';
						echo '<select class="form-control form-inline" name="startTime' . $days[$d] . '">';
						for ($i = 6; $i < 25; $i++){
								if ($i < 12){					
									echo '<option value="sunST' . $i . $am .'">'
												. 'Start' . " " . $i  . " " . $am .
												'</option>';	
								}
								elseif ($i == 12){
									echo '<option value="sunST' . $i . $pm .'">'
												. 'Start' . " " . $i . " " . $pm .
												'</option>';	
								}
								else{
									echo '<option value="sunST' . $i . $pm .'">'
												. 'Start' . " " . ($i - 12) . " " . $pm .
												'</option>';	
								}
							}
							echo '</select>';
							echo '</br >';
							
							echo '<select class="form-control form-inline" name="endTime' . $days[$d] . '">';
							for ($i = 6; $i < 25; $i++){
								if ($i < 12){					
									echo '<option value="sunST' . $i . $am .'">'
												. 'End' . " " . $i  . " " . $am .
												'</option>';	
								}
								elseif ($i == 12){
									echo '<option value="sunST' . $i . $pm .'">'
												. 'End' . " " . $i . " " . $pm .
												'</option>';	
								}
								else{
									echo '<option value="sunST' . $i . $pm .'">'
												. 'End' . " " . ($i - 12) . " " . $pm .
												'</option>';	
								}
							}
						echo '</select>';
						echo '</td>';
					}

				?>
				
			</tr>
		</table>
		</div>
		
		<div class="row">
			<div class="col-lg-12"></div>
		</div>
		
		<div class="form-group">
			<div class="col-lg-4"></div>
            <div class="col-lg-4 form-actions text-center">	  
				<button type="save" class="btn btn-primary" id="saveSchedule" name="saveSchedule">Save Changes</button>
              <span></span>
				<a href="?action=edit_Schedule"><input id="canelBtn" class="btn btn-default" type="button" value="Cancel"></a>
            </div>
			<div class="col-lg-4"></div>
          </div>
		
	</form>
	</div>
	<div class="col-lg-2"></div>
	
</body>
<footer class="col-lg-12 container-fluid text-center" style="position: fixed; bottom: 0; width: 100%;">
		<div class="container">
			<h4>CITLab &nbsp;<small> Lane Community College &copy; 2017</small></h4>
		</div>
</footer>
</html>