<?php include 'header.php'; ?>
<div class="container-fluid" style="width:750px;">
	  <div class="row content">

		<div class="col-sm-12">
		  <h2>Tutor Schedule</h2>
		  <table class="table table-responsive table-striped table-bordered">
		   <thead>
                <td class="col-xs-2"></td>
                <td class="col-xs-2">Monday</td><td class="col-xs-2">Tuesday</td><td class="col-xs-2">Wednesday</td><td class="col-xs-2">Thursday</td><td class="col-xs-2">Friday
				</td>
            </thead>
		  <?php
            $ampm = 'am';
            for ($time = 9; $time<=17; $time++) {
                if ($time == 12) {
                    $ampm = 'pm';
                    $hour = $time;
                } elseif ($time >= 13) {
                    $ampm = 'pm';
                    $hour = $time-12;
                } else {
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

<script>
	$(document).ready(function() {
		<?php $schedules = ScheduleDB::GetAllSchedules();
            foreach ($schedules as $schedule) {
                $day = $schedule->getWeekDay();
                $start = $schedule->getStartTime();
                $end = $schedule->getEndTime();
                $fStart = Date('G', strtotime($start));
                $fEnd = Date('G', strtotime($end));
                $tutor = TutorDB::RetrieveTutorByID($schedule->getUserID());
                $name = $tutor->getFirstName();

                for ($i = $fStart; $i <= $fEnd; $i++) {
                    ?>
	    			$("#<?php echo $i . $day; ?>").append("<p style='width:100%;'><?php echo $name; ?></p>");
		  <?php 
                }
            } ?>
	});


</script>
