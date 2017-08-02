<?php

//include 'C:\wamp\www\CIT_Remote_Monitoring_App\App\Models\db.php';
include($_SERVER["DOCUMENT_ROOT"] . "/CIT_Remote_Monitoring_App/App/Models/db.php");
$instructorLines = file("C:\wamp64\www\CIT_Remote_Monitoring_App\Mock_Data\LIVE\zsriinf_cit.txt");
$studentLines = file("C:\wamp64\www\CIT_Remote_Monitoring_App\Mock_Data\LIVE\zsrsinf_cit.txt");
//$lines = file("zsrsinf_cit.txt");
$db = Database::getDb();
$insert1 = 'INSERT INTO Major (MajorName) Values ("CIT")';
$insert2 = 'INSERT INTO Major (MajorName) Values ("Underwater Basket Weaving")';

$statement = $db->prepare($insert1);
$statement->execute();
$statement->closeCursor();

$statement = $db->prepare($insert2);
$statement->execute();
$statement->closeCursor();

foreach($instructorLines as $line)
{

    $trim_line = preg_replace('/"\s+"/', '""', $line);
	echo $trim_line . "<br/>";
	$parts = explode('""', $trim_line);
	$output = array();
	foreach ($parts as $part)
	{
		$trim_part = preg_replace('/"/', '', $part);
		echo $trim_part . "<br />";

		if ( $trim_part != "")
		{
			array_push($output, $trim_part);
		}

	}

	$lnum = $output[0];
	$firstName = $output[2];
	$lastName = $output[1];
	$email = end($output);

	$query1 = 'SELECT LNumber FROM AppUser WHERE LNumber = :lnum';
	$statement = $db->prepare($query1);
	$statement->bindValue(':lnum', $lnum);
	$statement->execute();
	$rows = $statement->fetchAll();
	$statement->closeCursor();


	echo count($rows) . "<br/>";

	if (count($rows) == 0)
	{

		$query2 = 'INSERT INTO AppUser(FirstName, LastName, LNumber, EmailAddress)
							 VALUES (:firstName, :lastName, :lnum, :email)';

		$statement = $db->prepare($query2);
		$statement->bindValue(':firstName', $firstName);
		$statement->bindValue(':lastName', $lastName);
		$statement->bindValue(':lnum', $lnum);
		$statement->bindValue(':email', $email);
		$statement->execute();
		$statement->closeCursor();
	}
	else
	{
		if (strpos($email, 'lanecc.edu'))
		{
			$query3 = 'UPDATE appuser SET EmailAddress = :email WHERE LNumber = :lnum';
			$statement = $db->prepare($query3);
			$statement->bindValue(':lnum', $lnum);
			$statement->bindValue(':email', $email);
			$statement->execute();
			$statement->closeCursor();

		}
	}
	$query3 = 'SELECT UserID FROM AppUser WHERE LNumber = :lnum';
	$statement = $db->prepare($query3);
	$statement->bindValue(':lnum', $lnum);
	$statement->execute();
	$rows2 = $statement->fetch();
	$statement->closeCursor();
	$userID = $rows2[0];

	$query4 = 'INSERT INTO instructor(UserID) VALUES (:userID)';
	$statement = $db->prepare($query4);
	$statement->bindValue(':userID', $userID);
	$statement->execute();
	$statement->closeCursor();




	echo $lnum . "<br />" . $lastName . "<br />" . $firstName . "<br />" . $email . "<br />";

}
foreach($studentLines as $line)
{

    $trim_line = preg_replace('/"\s+"/', '""', $line);
	echo $trim_line . "<br/>";
	$parts = explode('""', $trim_line);
	$output = array();
	foreach ($parts as $part)
	{
		$trim_part = preg_replace('/"/', '', $part);
		echo $trim_part . "<br />";

		if ( $trim_part != "")
		{
			array_push($output, $trim_part);
		}

	}

	$lnum = $output[0];
	$firstName = $output[2];
	$lastName = $output[1];
	$email = end($output);

	$query1 = 'SELECT LNumber FROM AppUser WHERE LNumber = :lnum';
	$statement = $db->prepare($query1);
	$statement->bindValue(':lnum', $lnum);
	$statement->execute();
	$rows = $statement->fetchAll();
	$statement->closeCursor();


	echo count($rows) . "<br/>";

	if (count($rows) == 0)
	{

		$query2 = 'INSERT INTO AppUser(FirstName, LastName, LNumber, EmailAddress)
							 VALUES (:firstName, :lastName, :lnum, :email)';

		$statement = $db->prepare($query2);
		$statement->bindValue(':firstName', $firstName);
		$statement->bindValue(':lastName', $lastName);
		$statement->bindValue(':lnum', $lnum);
		$statement->bindValue(':email', $email);
		$statement->execute();
		$statement->closeCursor();
	}
	else
	{
		if (strpos($email, 'lanecc.edu'))
		{
			$query3 = 'UPDATE appuser SET EmailAddress = :email WHERE LNumber = :lnum';
			$statement = $db->prepare($query3);
			$statement->bindValue(':lnum', $lnum);
			$statement->bindValue(':email', $email);
			$statement->execute();
			$statement->closeCursor();

		}
	}
	$query3 = 'SELECT UserID FROM AppUser WHERE LNumber = :lnum';
	$statement = $db->prepare($query3);
	$statement->bindValue(':lnum', $lnum);
	$statement->execute();
	$rows2 = $statement->fetch();
	$statement->closeCursor();
	$userID = $rows2[0];

	$query4 = 'INSERT INTO student(UserID, majorID) VALUES (:userID, 1)';
	$statement = $db->prepare($query4);
	$statement->bindValue(':userID', $userID);
	$statement->execute();
	$statement->closeCursor();




	echo $lnum . "<br />" . $lastName . "<br />" . $firstName . "<br />" . $email . "<br />";

}
?>
