<?php include 'header.php'; ?>
<div class="container-fluid" style="width:750px;">    
	  <div class="row content">
		
		<div class="col-sm-12"> 
		  <h2>Tutor Schedule</h2>
		  <table class="table table-responsive table-striped table-bordered">
		   <thead>
                <td></td>
                <td>Monday</td><td>Tuesday</td><td>Wednesday</td><td>Thursday</td><td>Friday
				</td>
            </thead>
		  <?php
			$ampm = 'am';			
			for($time = 9; $time<=17; $time++)
			{
				
				if ($time == 12) {
					$ampm = 'pm';
					$hour = $time;
				}
				else if ($time >= 13) {
					$ampm = 'pm';
					$hour = $time-12;
				} else 
				{
					$ampm = 'am';
					$hour = $time;
				};
				
				echo '<tr><th scope="row">' . $hour . ' ' . $ampm . '</th>
					 <td id="'. $time . '1"></td>
					 <td id="'. $time . '2"></td>
					 <td id="'. $time . '3"></td>
					 <td id="'. $time . '4"></td>
					 <td id="'. $time . '5"></td>
				</tr>';
			}
		  ?>
		  
        </table>  
		</div>
	  </div>
	</div>
<?php include 'footer.php'; ?>

		<?php $schedules = ScheduleDB::GetAllSchedules();
			foreach($schedules as $schedule) 
			{
				$day = $schedule->getWeekDay();
				$start = $schedule->getStartTime();
				$end = $schedule->getEndTime();
				$fStart = Date('G', strtotime($start));
				$fEnd = Date('G', strtotime($end));
				$tutor = TutorDB::GetTutorByID($schedule->getUserID());
				$name = $tutor->getFirstName();
			
				for ($i = $fStart; $i <= $fEnd; $i++) 
				{
					echo '$("#' . $i . $day . '").append("' . $name . '?>");';
				}
			}
		?>

<script>
	$(document).ready(function() {
		console.log("test <?php echo $day; ?>");
	});
		
</script>