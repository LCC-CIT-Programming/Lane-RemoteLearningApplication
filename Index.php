<?php
try {
require_once('/Models/AppUser.php');
require_once('/Models/Student.php');
require_once('/Models/StudentDB.php');
require_once('/Models/db.php');


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
	$action = filter_input(INPUT_GET, 'action');
	if ($action == NULL) {
		$action = 'default';
	}
}


switch($action) {
	case "default":
			$loginError = "";
			include("Views/login.php");
	break;

	case "login":
			$username = filter_input(INPUT_POST, "lnumber");
			$password = filter_input(INPUT_POST, "password");
			$role = filter_input(INPUT_POST, "isTutor");

			if ($role == NULL) {
					$user = StudentDB::StudentLogin($username, $password);

					if ($user !== null && isset($user)) {
							$_SESSION['user'] = $user;
							include("/Views/home.php");
					} else {
							$_SESSION['user'] = null;
							$loginError = "Login attempt failed.";
							include("Views/login.php");
					}
			}
	break;
}

} catch(Exception $e) {

	}

 ?>
