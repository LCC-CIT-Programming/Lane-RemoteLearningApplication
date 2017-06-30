<?php
include_once('../Models/db.php');
//require_once('../Models/AppUser.php');
function canConnect()
{
    $username = 'root';
    $password = '';
    $connect = new PDO('mysql:host=localhost;dbname=citlabmonitor', $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($connect)) {
        echo "<p style='color:green;'> Connection was successful! </p>";
    } else {
        echo "<p style='color:red;'> Connection was not successful </p>";
    }
}
function canUseDBConnection()
{
    $connect = Database::getDB();

    if (isset($connect)) {
        echo "<p style='color:green;'> Connection was successful! </p>";
    } else {
        echo "<p style='color:red;'> Connection was not successful </p>";
    }
}
function canGetStudentName($userID)
{
    $db = Database::getDB();

    $stmt = $db->prepare('SELECT FirstName
				FROM Appuser
				WHERE UserID = ?');
    $stmt->execute([$userID]);
    $name = $stmt->fetchColumn();


    if (isset($name)) {
        echo "<p style='color:green;'> Student name is :  $name </p>";
    } else {
        "<p style='color:red;'> get Student name was not successful </p>";
    }
}
function canGetStudent($username, $password)
{
    $db = Database::getDB();
    $stmt = $db->prepare('SELECT *
				FROM Appuser
				WHERE LNumber = ? AND Password =?');
    $stmt->execute([$username, $password]);
    $student = $stmt->fetch();

    if (isset($student)) {
        echo "<p style='color:green;'> You got a student !</p>";
    } else {
        "<p style='color:red;'> get Student name was not successful </p>";
    }
}

$userID = 5;
$username = 'L00000005';
$password = 'Student1';
canConnect();
canUseDBConnection();
canGetStudentName($userID);
canGetStudent($username, $password);
