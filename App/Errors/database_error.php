<!DOCTYPE html>
<html lang="en-US">

<head>
  <title>LCC CIT Lab Student Home</title>

  <link rel="stylesheet" type="text/css" href="./Styles/main.css">
  <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">


  <meta charset="UTF-8">
  <meta name="google" content="notranslate">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Language" content="en">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">



</head>


<div class="title">
  <div class="container text-center">
    <h1>Error Page</h1>
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
		<li><a href="?action=home">Home</a></li>

		<li><a href="?action=schedule">Schedule</a></li>
	<li><a href='?action=ask'>Questions</a></li>	  </ul>
	</div>
  </div>
</nav>



      <div class="modal-footer">
				<div id="acceptedModalButtons">
					<button id="studentResolveQuestion" type="button" class="btn btn-success" data-dismiss="modal">Resolved</button>
			  </div>
      </div>
    </div>

  </div>
</div>
<?php include '../Views/header.php'; ?>
<div id="main">
    <center><h1>Error</h1>
    <p>Something went tragically wrong. Try again later.</p></center>
</div><!-- end main -->
<?php include '../Views/footer.php'; ?>

</body>
<footer class="container-fluid text-center" style="position: fixed; bottom: 0; width: 100%;">
		<div class="container">
			<h4>CITLab &nbsp;<small> Lane Community College &copy; 2017</small></h4
		</div>
</footer>
</html>
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


