<!DOCTYPE html>
<html lang="en">

<head>
  <title>LCC CIT Lab Student Home</title>
  
  <link rel="stylesheet" type="text/css" href="./Styles/main.css">
  
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
		<li><a href="?action=home">Home</a></li>
		<li><a href="?action=schedule">Schedule</a></li>
		<li class="active"><a href="#">Questions</a></li>
	  </ul>
	  <ul class="nav navbar-nav navbar-right">
		<li><a href="#"><span class="glyphicon glyphicon-envelope"><span class="badge">"<?php echo '1'?>"</span></span></a></li>
		<li><a href="?action=logout"><span ></span> Logout</a></li>
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
                    
                    <form  method="post" action=".?=ask_question" class="form-horizontal" id="ask_question_form">
					<input type="hidden" name="action" value="ask_question" />
                        <div class="form-group">
                            <label class="control-label">Select A Course</label>
                            <div class="col-md-9">
                                <select id="course" name="courseSelect" class="form-control">
 
									<?php 
										$user = $_SESSION['user'];
										$courses = $_SESSION['courses'];
									 foreach ($courses as $course) : 
										{ 
											echo '<option value="' . $course->getCourseNumber() . '">'
												. $course->getCourseName() .
												'</option>';
										}
										endforeach;
									?>
	
                                </select>
                            </div>
                        </div>

						
                        <div class="form-group">
							<label class="control-label">Problem Subject</label>
                            <div class="col-md-9">
                                <input type="text" name="subject" class="form-control"  placeholder="Subject" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                            <textarea id="question" name="description" class="form-control"  rows="5" placeholder="Enter your question" required></textarea>     
							
                            </div>
                        </div>
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-3">
							<div class="form-actions">
							   <button type="submit" class="btn btn-primary">Submit Question</button>
							   <!--<input class="btn btn-primary" type="submit" name="submit" value="Submit question">-->
							</div>
							
							</div>
								
							  
							<div class="col-md-3">
								<a href="?action=home"><input id="returnBtn" class="btn btn-primary" type="button" value="Take me back!"></a>
							</div>
							<div class="col-md-3"></div>

						</div>
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-6">
								  <span class="error" style="color:red; font-weight:bold"><?php echo $questionError; ?></span>
							  </div>
							<div class="col-md-3">
							  </div>
						</div>
						
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-6">
								   <span class="success"  style="color:blue; font-weight:bold"><?php echo $success; ?></span>
							  </div>
							<div class="col-md-3">	 
							  </div>
						</div>
						
                    </form>
                </div>
</div>