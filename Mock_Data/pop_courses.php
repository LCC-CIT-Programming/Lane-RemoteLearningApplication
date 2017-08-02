<?php

//include 'C:\wamp\www\CIT_Remote_Monitoring_App\App\Models\db.php';
include($_SERVER["DOCUMENT_ROOT"] . "/CIT_Remote_Monitoring_App/App/Models/db.php");
$lines = file("C:\wamp64\www\CIT_Remote_Monitoring_App\Mock_Data\LIVE\zsrsecl_cit.txt");
$studentRegistrationLines = file("C:\wamp64\www\CIT_Remote_Monitoring_App\Mock_Data\LIVE\zsrslst_cit.txt");
$db = Database::getDb();

$insert1 = 'INSERT INTO Term (TermID, TermName) Values (0,"Summer")';
$insert2 = 'INSERT INTO Term (TermID, TermName) Values (1,"Fall")';
$insert3 = 'INSERT INTO Term (TermID, TermName) Values (2,"Winter")';
$insert4 = 'INSERT INTO Term (TermID, TermName) Values (3,"Spring")';

$statement = $db->prepare($insert1);
$statement->execute();
$statement->closeCursor();

$statement = $db->prepare($insert2);
$statement->execute();
$statement->closeCursor();

$statement = $db->prepare($insert3);
$statement->execute();
$statement->closeCursor();

$statement = $db->prepare($insert4);
$statement->execute();
$statement->closeCursor();

foreach($lines as $line)
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
	$sectionNum = $output[1];
	$courseNum = $output[2] . " " . $output[3];
	$courseName = $output[4];
	$leadInstructor = $output[5];
	$startDate = $output[9];
	$termID = 0;
	
	if ($startDate != 'N/A') {
		$dateParts = explode('-', $startDate);
		$month = $dateParts[1];
		$year = $dateParts[2];
		echo $month . " " . $year . '<br />';
	}
	
	
	
	$query1 = 'SELECT CourseNumber FROM Course WHERE CourseNumber = :coursenum';
	$statement = $db->prepare($query1);
	$statement->bindValue(':coursenum', $courseNum);
	$statement->execute();
	$rows = $statement->fetchAll();
	$statement->closeCursor();
	
	$query2 = 'SELECT UserID FROM AppUser WHERE LNumber = :leadinstructor';
	$statement = $db->prepare($query2);
	$statement->bindValue(':leadinstructor', $leadInstructor);
	$statement->execute();
	$rows2 = $statement->fetch();
	$statement->closeCursor();
	$userID = $rows2[0];
	echo $userID . "<br/>";
	
	
	echo count($rows) . "<br/>";
	
	if (count($rows) == 0)
	{
	
		$query3 = 'INSERT INTO COURSE(CourseName, CourseNumber, LeadInstructorId)
							 VALUES (:coursename, :coursenum, :leadinstructor)';
	
		$statement = $db->prepare($query3);
		$statement->bindValue(':coursenum', $courseNum);
		$statement->bindValue(':coursename', $courseName);
		$statement->bindValue(':leadinstructor', $userID);
		$statement->execute();
		$statement->closeCursor();
	}
	
	switch ($month)
	{
		case "JUN":
			$termID = 0;
			break;
		case "SEP":
			$termID = 1;
			break;
		case "JAN":
			$termID = 2;
			break;
		case "APR":
			$termID = 3;
			break;
		case "DEFAULT":
			$termID = -1;
	}
	
	$query4 = 'INSERT INTO section (CourseNumber, SectionNumber, TermId, UserID, Year) 
							VALUES(:coursenum, :sectionnum, :termid, :instructor, :year)';
	
	$statement = $db->prepare($query4);
	$statement->bindValue(':coursenum', $courseNum);
	$statement->bindValue(':sectionnum', $sectionNum);
	$statement->bindValue(':termid', $termID);
	$statement->bindValue(':instructor', $userID);
	$statement->bindValue(':year', $year);
	$statement->execute();
	$statement->closeCursor();

		
}

$counter = 0;
//echo $counter . "<br />";

//echo count($studentRegistrationLines) . "<br />";
foreach ($studentRegistrationLines as $line)
{
	if ($counter == 1)
	{
		break;
	}
		
		
	
	$trim_line = preg_replace('/"\s+"/', '""', $line);
	//echo $trim_line . "<br/>";
	$parts = explode('""', $trim_line);
	$output = array();
	foreach ($parts as $part)
	{
		$trim_part = preg_replace('/"/', '', $part);
		//echo $trim_part . "<br />";
			
		if ( $trim_part != "")
		{
			array_push($output, $trim_part);			
		}
		
	}
	$lnum = $output[0];
	$sectionNum = $output[1];
	echo $sectionNum . "<br />";
	
	$query5 = 'SELECT student.UserID FROM student 
					inner join Appuser 
					on appuser.UserId = student.UserId 
					WHERE appuser.LNumber = :lnum';
	$statement = $db->prepare($query5);
	$statement->bindValue(':lnum', $lnum);
	$statement->execute();
	$rows = $statement->fetch();
	$statement->closeCursor();
	$userID = $rows[0];
	echo $userID . "<br />" .  "<br />";
	
	$query6 = 'INSERT INTO studentregistration (SectionNumber, UserID)
							VALUES(:sectionnum, :userid)';
	$statement = $db->prepare($query6);
	$statement->bindValue(':sectionnum', $sectionNum);
	$statement->bindValue(':userid', $userID);
	$statement->execute();
	$statement->closeCursor();
	/*
	$query7 = 'SELECT * FROM studentregistration';
	$statement = $db->prepare($query7);
	$statement->execute();
	$statement->closeCursor();
	$rows = $statement->fetchAll();
	
	foreach ($rows as $row)
	{
		echo count($row) . "<br />" . "<br />";
		echo $row[0] . "<br />" . $row[1] . "<br />";
	
	}
	*/
	
	//echo $sectionNum . "<br />" . $userID . "<br />";
	//$counter ++;
	//echo $counter . "<br />";
	
}

?>