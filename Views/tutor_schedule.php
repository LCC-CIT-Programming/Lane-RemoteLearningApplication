<?php include 'header.php'; ?>

	<div class="container-fluid" style="margin-top: 20px; width: 500px">

	<form method="post" action=".?action=edit_schedule" style="margin-bottom: 75px;">
  	<div class = "form-group">
      <div class="shifts-container">
    		<div class="row" style="margin-bottom: 10px;">
    			<div class = "col-md-5">
    				<input type="date" name="Day" id="Date" style="width:100%" />
    			</div>

    			<div class = "col-md-3">
    				<input type="time" name="StartTime" id="Start" style="width:100%"/>
    			</div>

    			<div class = "col-md-3">
    				<input type="time" name="EndTime" id="End" style="width:100%"/>
    			</div>

          <!-- <div class="col-md-1 pull-right" style="height: 25px; width: 25px;">
            <button class="btn btn-success pull-right add_field" style="border-radius: 50%;">+</button>
          </div> -->

    		</div>
      </div>
		</div>

		<button type="submit" class="btn btn-primary">Add shift to my schedule</button>
		</form>

		<table class="table table-responsive table-condensed">
		<thead>
			<tr>
				<th>Day</th><th>Start time</th><th>End time</th><th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			if ($schedules != null) {
				foreach ($schedules as $schedule) {
					$day =  $schedule->getStringWeekDay();
					$start = new DateTime($schedule->getStartTime());
					$end = new DateTime($schedule->getEndTime());
					$fstart = $start->format('H:i A');
					$fend = $end->format('H:i A');
					echo '<tr><td>';
					echo $day;
					echo '</td><td>';
					echo $fstart;
					echo '</td><td>';
					echo $fend;
					echo '</td><td>';
					echo '<form action="?action=delete_schedule" method="post">';
					echo '<input type="hidden" name="id" value="';
					echo $schedule->getScheduleID();
					echo '?>">';
					echo '<input class="btn btn-danger" type="submit" name="submit" value="Delete"></form>';
					echo '</td></tr>';
				}
			}
			else {
				echo '<tr><td> You are not currently scheduled </td></tr>';
			}
      ?>
		</tbody>
		</table>

	</div>

<?php include 'footer.php'; ?>


<!-- <script>
$(document).ready(function() {
    var max_fields = 5; //maximum input boxes allowed
    var wrapper    = $(".shifts-container"); //Fields wrapper
    var add_button = $(".add_field"); //Add button ID
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="row" style="margin-bottom: 10px;"> <div class = "col-md-5"><input type="date" name="Days[]" id="Day" style="width:100%" /></div>' +
            '<div class = "col-md-3"><input type="time" name="Starts[]" id="Start" style="width:100%"/></div><div class = "col-md-3">' +
            '<input type="time" name="Ends[]" id="End" style="width:100%"/></div><a href="#" class="col-md-1 remove_field">Remove</a></div></div>')
        }
    });
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script> -->

<script>
$('.delete').click(function() {
   $.ajax({
      type: "POST",
      url: "?action=delete_schedule",
      data: { id : this.value }
   });
    });
</script>
