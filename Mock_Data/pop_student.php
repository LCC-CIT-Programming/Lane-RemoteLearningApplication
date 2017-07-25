<?php
include 'C:\wamp\www\CIT_Remote_Monitoring_App\App\Models\db.php';
$lines = file("mcl_app_user_student.txt");
$db = Database::getDb();

foreach($lines as $line)
{
    $trim_line = preg_replace('/\s+/', "", $line);
	$parts = explode('"', $trim_line);
	$output = array();
	foreach ($parts as $part)
	{
			
		if ( $part != "")
		{
			array_push($output, $part);			
		}
		
	}

	$lnum = $output[0];
	$firstName = $output[2];
	$lastName = $output[1];
	$email = end($output);
	
	$query1 = 'INSERT INTO AppUser(FirstName, LastName, LNumber, EmailAddress)
							 VALUES (:firstName, :lastName, :lnum, :email)';
	$statement = $db->prepare($query1);
	$statement->bindValue(':firstName', $firstName);
    $statement->bindValue(':lastName', $lastName);
    $statement->bindValue(':lnum', $lnum);
    $statement->bindValue(':email', $email);
	$statement->execute();
	$statement->closeCursor();
	echo $lnum . "<br />" . $lastName . "<br />" . $firstName . "<br />" . $email . "<br />";
	
	
}

?>