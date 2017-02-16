<!DOCTYPE html>
<html lang="en">

<head>
  <title>LCC CIT Lab Student Home</title>
  
  <link rel="stylesheet" type="text/css" href="../Styles/main.css">
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</head>

<div class="title">
  <div class="container text-center">
    <h1>Lane Community College CIT Lab</h1>      
  </div>
</div>

<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
	<div class="navbar-header">
	  <a class="navbar-brand" href="#">CIT Lab</a>
	</div>
	<div class="collapse navbar-collapse" id="navbar">
	  <ul class="nav navbar-nav">
		<li><a href="home.php">Home</a></li>
		<li><a href="schedule.php">Schedule</a></li>
		<li class="active"><a href="ask.php">Questions</a></li>
	  </ul>
	  <ul class="nav navbar-nav navbar-right">
		<li><a href="#"><span class="glyphicon glyphicon-envelope"><span class="badge">"<?php echo '1'?>"</span></span></a></li>
		<li><a href="#"><span ></span> Logout</a></li>
	  </ul>
	</div>
  </div>
</nav>
<div class="container-fluid">
<div class="row">
	<div class="col-md-12">
	<br />
	<br />
	</div>
</div>

<div class="col-sm-3"></div>
<div id="questionFormContainer" class="col-md-6  well">
                    <h1 class="text-center text-primary">New Question</h1>
                    
                    <form  method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label">Select A Course</label>
                            <div class="col-md-9">
                                <select id="course" name="CourseNumber" class="form-control">
                                    
									
									<?php
										$user = $_SESSION['user'];
										$courses = $_SESSION['courses'];
										foreach($courses as $course)
										{
											echo '<option>' . $course->getCourseName() . '</option>';
										}
									?>
									
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
							<label class="control-label">Problem Subject</label>
                            <div class="col-md-9">
                                <input type="text" name="subject" class="form-control"  placeholder="Subject">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                            <textarea id="question" name="question" class="form-control"  rows="5" placeholder="Enter your question" required></textarea>     
							
                            </div>
                        </div>
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-3">
								<input class="btn btn-primary" type="submit" name="submit" value="Submit question">
							</div>
							<div class="col-md-3">
								<a href="home.php"><input id="returnBtn" class="btn btn-primary" type="button" value="Take me back!"></a>
							</div>
							<div class="col-md-3"></div>
						</div>
						
                    </form>
                </div>
</div>



