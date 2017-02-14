<?php
include_once('../Models/Question.php');
include_once('../Models/QuestionDB.php');
include_once('../Models/db.php');


function canGetOpenQuestions() {
  $questions = QuestionDB::GetOpenQuestions();
  if ($questions[0]->getQuestionID() == 13) {
    echo "<p style='color:green;'>  Get open questions was successful! </p>";
  } else {
    echo "<p style='color:red;'> Get open questions not successful! </p>";
  }
}

function canGetQuestion() {
  $questions = QuestionDB::GetOpenQuestions();
  $question = $questions[0];
  $test =  QuestionDB::GetQuestion($question);
  if ($test->getQuestionID() == 13) {
    echo "<p style='color:green;'>  Get question was successful! </p>";
  } else {
    echo "<p style='color:red;'> Get question not successful! </p>";
  }
}

function canUpdateQuestion(){
	$questions = QuestionDB::GetOpenQuestions();
  $question = $questions[0];
  $question->setOpenTime('2017-02-07');
  $question->setCloseTime('2017-02-07');
  $question->setStatus('Open');
  QuestionDB::UpdateQuestion($question);
  $questions = QuestionDB::GetOpenQuestions();
  $test = $questions[0];
  if ($test->getOpenTime() == '2017-02-07 00:00:00') {
    echo "<p style='color:green;'>  Update Question question was successful! </p>";
  } else {
    echo "<p style='color:red;'> Update question not successful! </p>";
	echo $test->getOpenTime();
  }

function canCreateQuestion() {
  $question = new Question('16', '5', 'CIS 244', 'test subject', 'just testing', 'Open', '2017-08-02');
  QuestionDB::CreateQuestion($question);
  $valid = QuestionDB::GetQuestion($question);

  if ($valid != null) {
    echo "<p style='color:green;'>Create question was successful! </p>";
  } else {
    echo "<p style='color:red;'>Create question not successful! </p>";
  }
}

function canDeleteQuestion() {
  $question = new Question('16', '5', 'CIS 244', 'test subject', 'just testing', 'Open', '2017-08-02');
  QuestionDB::deleteQuestion($question);
  $valid = QuestionDB::GetQuestion($question);

  if ($valid == null) {
    echo "<p style='color:green;'>Delete question was successful! </p>";
  } else {
    echo "<p style='color:red;'>Delete question not successful! </p>";
  }
}

}

canGetOpenQuestions();
canGetQuestion();
canUpdateQuestion();
canCreateQuestion();
canDeleteQuestion();
?>
