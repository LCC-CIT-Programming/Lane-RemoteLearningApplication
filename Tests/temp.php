<?php
include_once('../Models/Question.php');
include_once('../Models/QuestionDB.php');
include_once('../Models/db.php');

$question1 = new Question('2', '5', 'CIS 244', 'test subject', 'just testing', 'Open', '2017-08-02');
$question2 = new Question('3', '6', 'CS 296P', 'test2 subject', 'just testing again', 'Open', '2017-08-02');

QuestionDB::CreateQuestion($question1);
QuestionDB::CreateQuestion($question2);
?>
