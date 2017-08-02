<!-- The header includes body tag and nav... include on all pages and begin page with <div class= "container-fluid">-->
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
		<li><a href="?action=home">Home</a></li>

		<li><a href="?action=schedule">Schedule</a></li>
	<?php
    $role = $_SESSION['role'];
    if ($role == 'student') {
        echo "<li><a href='?action=ask'>Questions</a></li>";
    } elseif ($role == 'tutor') {
        echo "<li><a href='?action=edit_schedule'>Edit My Schedule</a></li>";
    }
    ?>
	  </ul>
	  <ul class="nav navbar-nav navbar-right">
		<li><a href="?action=logout"><span ></span>Logout</a></li>
	  </ul>
	</div>
  </div>
</nav>

<!-- Modal -->
<div id="acceptedModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header text-center">
        <p style="font-size: 24px; font-family: 'Cinzel', serif; font-weight:bold;">Question Accepted!</p>
      </div>

      <div class="modal-body row">
        <div id="acceptedModalBody">

          <div class="text-center">
            <h3 id="tutorName"></h3>
            <p style="font-size: 16px;">Meet up at hangouts.google.com!</p>
            <p id="tutorEmail"></p>
          </div>

				</div>
      </div>

      <div class="modal-footer">
				<div id="acceptedModalButtons">
					<button id="studentResolveQuestion" type="button" class="btn btn-success" data-dismiss="modal">Resolved</button>
			  </div>
      </div>
    </div>

  </div>
</div>

<script>
    $(document).ready(function() {
      CheckAcceptedQuestions();
      setInterval(function() {
        CheckAcceptedQuestions();
      }, 30000);
    });

    $('#studentResolveQuestion').click(function() {
      var val = $(this).val();
      $.post('', { action:'resolve_question', resolveQuestion:val });
    });

    function CheckAcceptedQuestions() {
      $.post('', { action:'check_accepted' }, function(ret) {
          var data = JSON.parse(ret);
          var modal = $('#acceptedModal');

          if (data != null) {
            $.each(data, function(key, val) {
              if (data[key]['uID'] == data[key]['ouID']) {
                $('#acceptedModal').modal('show');
                modal.find('#tutorName').html(data[key]['tutorFName'] + ' ' + data[key]['tutorLName'] + '  has accepted your question!');
                modal.find('#tutorEmail').html(data[key]['tutorEmail']);
                modal.find('#studentResolveQuestion').val(data[key]['qID']);
              }
            });
          }

    });
  }
</script>
