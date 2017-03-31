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
		<li class="active"><a href="#">Home</a></li>

		<li><a href="?action=schedule">Schedule</a></li>
	<?php
	$role = $_SESSION['role'];
	if ($role == 'student')
	{
		echo "<li><a href='?action=ask'>Questions</a></li>";
	}
  else if ($role == 'tutor') {
  		echo "<li><a href='?action=edit_schedule'>Edit My Schedule</a></li>";
  	}
	?>
	  </ul>
	  <ul class="nav navbar-nav navbar-right">
		<!--<li><a href="#"><span class="glyphicon glyphicon-envelope"><span class="badge">"<?php echo '1'?>"</span></span></a></li>
		-->
		<li><a href="?action=logout"><span ></span>Logout</a></li>
	  </ul>
	</div>
  </div>
</nav>

<!-- Container for student content -->
<div class="container-fluid" id="main_content_div">
	<div class="row">
	  <div class="container" id="status_div">
			<div class="col-sm-2"></div>
			<div class=" col-sm-4 form-group">
			<?php
	$role = $_SESSION['role'];
	if ($role == 'student')
	{
			echo "<label class='' for='class'>Please tell us what class you are working on.</label>";
			echo "<select class='form-control' id='class'>";


                    $courses = $_SESSION['courses'];
                    foreach($courses as $course)
                    {
                        echo '<option>' . $course->getCourseName() . '</option>';
                    }
	}
              ?>

			</select>


			</div>
			<div class=" col-sm-4 form-group">
			<label class="" for="location">Where are you working today?</label>
			<select class="form-control" id="location">
				<option>CIT Lab</option>
				<option>Elsewhere</option>
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
		<table class="table table-condensed table-responsive">


        <?php
          $questions = QuestionDB::getOpenQuestions();

          echo '<tr><th>Questions in queue: ' . count($questions) . '</th><th></th><th></th><th></th></tr>';
          echo '<tr>
                  <th>Course</th>
                  <th>Subject</th>
                  <th>Question</th>
                  <th>Time</th>
               </tr>';


        foreach ($questions as $question)
        {
          $course = CourseDB::RetrieveCourseByNumber($question->getCourseNumber());
			  //$user = $_SESSION['user'];
				if ($question->getUserID() == $user->getUserID())
				{
					echo '<tr class="success">';
				}
				else
				{
					echo '<tr>';
				}

				echo '<td>' . $course->getCourseName() . '</td>' .
                     '<td>' . $question->getSubject() . '</td>' .
                     '<td>' . $question->getDescription() . '</td>' .
                     '<td>' . $question->getAskTime() . '</td>' ;
				if ($question->getUserID() == $user->getUserID() && $role == 'student')
				{
					 echo '<td>' . '<button class="btn btn-danger">Cancel</button> ' . '</td>' .
					'</tr>';
				}
          }
      ?>

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
					  <th></th>
					  <th>Name</th>
					  <th>Status</th>
					  <th>Expertise</th>
					</tr>
				  </thead>

          <?php
              $tutors = TutorDB::GetOnlineTutors();

              if ($tutors != null) {
              foreach ($tutors as $tutor) {
                  echo '<tr><td></td>
                        <td>' . $tutor->getFirstName() . ' ' . $tutor->getLastName() . '</td>' .
                       '<td>' . 'Online' . '</td>' .
                       '<td>' . $tutor->getTutorBio() . '</td>' .
                       '</tr>';
              }
            } else {

              echo '<tr><td>There are no available tutors at this time.</td></tr>';
            }
          ?>

				</table>
			</div>

	</div>
</div>

</body>
<footer class="container-fluid text-center" style="position: fixed; bottom: 0; width: 100%;">
		<div class="container">
			<h4>CITLab &nbsp;<small> Lane Community College &copy; 2017</small></h4
		</div>
</footer>
</html>
