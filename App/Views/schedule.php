<?php include 'header.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.min.js"></script>

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
        
        <div id='tutorExpertise' >               
        </div>

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
                $tutorID = $tutor->getUserID();
                

                for ($i = $fStart; $i <= $fEnd; $i++) {
        ?>
                    $("#<?php echo $i . $day; ?>").append(
                    	"<a id='tutor_<?php echo $tutorID; ?>' class='isTutor' href='' style='width:100%;'><?php echo $name; ?></a>");

        <?php 
                } 
            } 
            $tutors = TutorDB::GetAllTutors();
            foreach ($tutors as $t){
              $tutorID = $t->getUserID();
              $bio = $t->getTutorBio();
        ?>
            $("div#tutorExpertise").append(
            	"<div class='isExpertise' id='tutor_<?php echo $tutorID; ?>'><h3><?php echo $bio; ?></h3></div>");
        <?php  }  ?>
        // hide each div tag that contains tutor experience
        $("div.isExpertise").hide();
        // add the event handler to show the experience for each tutor
        $("a.isTutor").hover( 
        	function(event){
    			var divThisTutor = "div#" + this.id;
    			//$(divThisTutor).css("position", "inline");
    			//$(divThisTutor).css("left", (event.pageX) + "px");
    			//$(divThisTutor).css("top", (event.pageY) + "px");
    			//$(divThisTutor).css("left:(event.pageX+20) + "px", top:(event.pageY+20) + "px"});
				$(divThisTutor).show();
			}, 
			function (event) {
			    var divThisTutor = "div#" + this.id;
				$(divThisTutor).hide();
			}
		);
		// clicking on a tutor shouldn't reload the page
		$("a.isTutor").click( function(event) { event.preventDefault(); });

  });
</script>
