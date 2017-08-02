<?php include './Views/header.php'; ?>

<!-- Container for student content -->
<div class="container-fluid" id="main_content_div">
	<div class="row">
	  <div class="container" id="status_div">
			<div class="col-sm-2"></div>
			<div class=" col-sm-4 form-group">
			<?php
		    $role = $_SESSION['role'];
		    if ($role == 'student') {
		        echo "<label class='' for='class' >Please tell us what class you are working on.</label>";
		        echo "<select class='form-control' id='class'>";


		        $courses = $_SESSION['courses'];
		        foreach ($courses as $course) {
		            echo '<option value = "' . $course->getCourseNumber().'" >' . $course->getCourseName() . '</option>';
		        }
    		}
    	?>
			</select>

			</div>
			<div class=" col-sm-4 form-group">
			<label class="" for="location">Where are you working today?</label>
			<select class="form-control" id="location">
				<option value="1">CIT Lab</option>
				<option value ="2">Elsewhere</option>
			</select>
			</div>
			<div class="col-sm-2"></div>
	  </div>
	</div>
	<div class="row">

	  <div class="col-lg-3 well" id="student_div">
		 <img src="./Styles/smiley.png" align="left" class="smiley">
		<h4 class="yourName"><?php echo $user->getFirstName(); ?></h4>
		<h4><a href="?action=edit">Edit Profile</a></h4>
	  </div>

	  <div class="col-lg-8 well" id="question_div" style="overflow: auto">
			<table class="table table-condensed table-responsive" id="questionsTable">
	      <!-- <tr>
				<!--<th>Questions in queue: <p id="questionCount"></p></th>
				<th></th><th></th><th></th><th></th>
				</tr>-->

	        <tr>
	          <th>Course</th>
	          <th>Subject</th>
	          <th>Question</th>
	          <th>Time</th>
						<th></th>
	        </tr>

					<tbody id="tableBody">

					</tbody>

			</table>
	  </div>

	</div>
</div>

<!-- Container for Tutor List -->
<div class="container-fluid" id="tutor_list_table_div">
	<div class="row">

			<div class="col-sm-12">
				<h1 id="tutor_header">Available Tutors</h1>
				<hr>
				<table class="table table-hover table-striped" id="tutor_list_table">
				  <thead>
					<tr>
					  <th>Name</th>
					  <th>Status</th>
					  <th>Expertise</th>
					</tr>
				  </thead>

          <?php
              $tutors = TutorDB::GetOnlineTutors();

              if ($tutors != null) {
                  foreach ($tutors as $tutor) {
                      echo '<tr>
                        <td>' . $tutor->getFirstName() . ' ' . $tutor->getLastName() . '</td>' .
                       '<td>' . 'Online' . '</td>' .
                       '<td>' . $tutor->getTutorBio() . '</td>' .
                       '</tr>';
                  }
              } else {
                  echo '<td>There are no available tutors at this time.</td>';
              }
          ?>

				</table>
			</div>

	</div>
</div>
<?php include 'footer.php'; ?>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header text-center">
        <p style="font-size: 24px; font-family: 'Cinzel', serif; font-weight:bold;">Question Details</p>
      </div>

      <div class="modal-body row">
        <div id="modalBody">
				<table>
					<tr class="col-xs-12"><th class="col-xs-3" style="min-width: 120px;">Student Name:</th><td class="col-xs-9" id="studentName"></td></tr>
					<tr class="col-xs-12" id="emailRow"><th class="col-xs-3" style="min-width: 120px;">Student Email:</th><td class="col-xs-9" id="studentEmail"></td></tr>
					<tr class="col-xs-12"><th class="col-xs-3" style="min-width: 120px;">Ask Time:</th><td class="col-xs-9" id="askTime"></td></tr>
					<tr class="col-xs-12"><th class="col-xs-3" style="min-width: 120px;">Course:</th><td class="col-xs-9" id="courseNumber"></td></tr>
					<tr class="col-xs-12"><th class="col-xs-3" style="min-width: 120px;">Subject:</th><td class="col-xs-9" id="subject"></td></tr>
					<tr class="col-xs-12"><th class="col-xs-3" style="min-width: 120px;">Question:</th><td class="col-xs-9" id="question"></td></tr>
				</table>

				</div>
      </div>

      <div class="modal-footer">
				<div id="modalButtons">
					<button id="acceptQuestion" type="button" class="btn btn-success">Accept</button>
        	<button id="closeDetails" type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
					<button id="resolveQuestion" type="button" class="btn btn-success" data-dismiss="modal">Resolved</button>
        	<button id="escalateQuestion" type="button" class="btn btn-warning" data-dismiss="modal">Escalate</button>
					<button id="openQuestion" type="button" class="btn btn-danger" data-dismiss="modal">Re-Open</button>
			  </div>
      </div>
    </div>

  </div>
</div>


<?php if(isset($task)) { ?>
	<script>
		$(document).ready(function() {
				$('#class option').each(function() {
					if ($(this).val() == "<?php $task->getCourseNumber() ?>")
							$(this).attr('selected', 'selected');
				});
		});
	</script>
<?php } ?>


<script>
$(document).ready(function() {
		loadTable();
		setInterval(function() {
			loadTable();
		}, 30000);

		$('#location option').each(function() {
			if ($(this).val() == "<?php echo $visit->getLocationID() ?>")
					$(this).attr('selected', 'selected');
		});

    $("#class").change( function(){
            $.ajax({
                    url: ".?action=update_task",
                    type: "POST",
                    data: {"courseNumber": $(this).val()},
           });
    });

	  $("#location").change( function(){
				$.ajax({
								url: ".?action=update_location",
								type: "POST",
								data: {"locationID": $(this).val()},
			  });
	  });

		$('#acceptQuestion').click(function() {
				var val = $(this).val();

				//POST QUESTIONID TO ACTION
	      $.post('', { action:'accept_question', acceptQuestion:val }, function(ret) {
	        var data = JSON.parse(ret);
					var modal = $('#myModal');

					modal.find('#courseNumber').html(data.courseNumber);
	        modal.find('#subject').html(data.subject);
	        modal.find('#question').html(data.question);
	        modal.find('#askTime').html(data.askTime);
					modal.find('#studentName').html(data.studentFirstName + " " + data.studentLastName);
					modal.find('#studentEmail').html(data.studentEmail);
					modal.find('#acceptQuestion').hide();
					modal.find('#closeDetails').hide();
					modal.find('#emailRow').show();
					modal.find('#resolveQuestion').show();
					modal.find('#escalateQuestion').show();
					modal.find('#openQuestion').show();

				  });
			});

			$('#openQuestion').click(function() {
				var val = $(this).val();
	      $.post('', { action:'reopen_question', openQuestion:val });
			});

			$('#escalateQuestion').click(function() {
				var val = $(this).val();
	      $.post('', { action:'escalate_question', escalateQuestion:val });
			});

			$('#resolveQuestion').click(function() {
				var val = $(this).val();
	      $.post('', { action:'resolve_question', resolveQuestion:val });
			});

});

$(document).on('click', '.details', function() {
		var val = $(this).val();

		//POST QUESTIONID TO ACTION
		$.post('', { action:'question_details', viewQuestion:val }, function(ret) {
			var data = JSON.parse(ret);

			//OPEN MODAL
			var modal = $('#myModal');
			modal.modal();

			//ADD INFORMATION TO TABLE
			modal.find('#courseNumber').html(data.courseNumber);
			modal.find('#subject').html(data.subject);
			modal.find('#question').html(data.question);
			modal.find('#askTime').html(data.askTime);
			modal.find('#studentName').html(data.studentFirstName + " " + data.studentLastName);
			modal.find('#acceptQuestion').val(data.questionID);
			modal.find('#resolveQuestion').val(data.questionID);
			modal.find('#escalateQuestion').val(data.questionID);
			modal.find('#openQuestion').val(data.questionID);
			modal.find('#acceptQuestion').show();
			modal.find('#closeDetails').show();
			modal.find('#emailRow').hide();
			modal.find('#resolveQuestion').hide();
			modal.find('#escalateQuestion').hide();
			modal.find('#openQuestion').hide();
		});
	});

	$(document).on('click', '.cancelQuestion', function() {
			var val = $(this).val();
	    $.post('', {
				action:'cancel_question',
				cancelQuestion:val
			})
			.done(function() { loadTable(); });
	});


function loadTable() {
	$.post('', { action:'display_questions' }, function(ret) {
			var data = JSON.parse(ret);
			if (data != null) {
				$('#tableBody').empty();
				$.each(data, function(key, val) {
					var rowStart = '<tr>';

					var myRowStart = '<tr class="success">';

					var cancel = '<td><button class="btn btn-danger cancelQuestion" type="submit" value="' + data[key]['questionID'] + '">Cancel</button></td>';

				  var details = '<td><button value="' + data[key]['questionID'] + '" type="button" class="btn btn-info details"' +
											 ' data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#myModal">Details</button></td>';

					var questionInfo = 		 '<td>' + data[key]['courseName'] + '</td>' +
																 '<td>' + data[key]['subject'] + '</td>' +
																 '<td>' + data[key]['description'] + '</td>' +
																 '<td>' + data[key]['askTime'] + '</td>';

					if (data[key]['askUserID'] == data[key]['userID'] && data[key]['userRole'] == "student") $("#tableBody").append(myRowStart);
					else  $("#tableBody").append(rowStart);

					$("#tableBody").append(questionInfo);
					if (data[key]['askUserID'] == data[key]['userID'] && data[key]['userRole'] == "student") $('#tableBody').append(cancel);
					if (data[key]['userRole'] == "tutor" || data[key]['userRole'] == "faculty") $('#tableBody').append(details);

					$("#tableBody").append('</tr>');
				});
			}
			else {
				$("#tableBody").append('<tr>There are currently no questions.</tr>');
			}
	});
}

</script>
