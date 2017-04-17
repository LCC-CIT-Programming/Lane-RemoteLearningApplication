<?php
include_once('../Models/question.php');
include_once('../Models/QuestionDB.php');
include_once('../Models/db.php');


function canGetOpenQuestions()
{
    $questions = QuestionDB::GetOpenQuestions();
    if (count($questions) > 0) {
        echo "<p style='color:green;'>  Get open questions was successful! </p>";
    } else {
        echo "<p style='color:red;'> Get open questions not successful! </p>";
    }
}

function canGetQuestion()
{
    $questions = QuestionDB::GetOpenQuestions();
    $question = $questions[0];
    $test = QuestionDB::GetQuestion($question);
    if ($test != null) {
        echo "<p style='color:green;'>  Get question was successful! </p>";
    } else {
        echo "<p style='color:red;'> Get question not successful! </p>";
    }
}

function canCreateQuestion()
{
    $question = new Question('5', 'CIS 244', 'test subject', 'just testing', 'Open', '2017-08-02');
    try {
        QuestionDB::CreateQuestion($question);
        echo "<p style='color:green;'>Create question was successful! </p>";
    } catch (PDOException $e) {
        echo "<p style='color:red;'>Create question not successful! </p>";
        echo $e;
    }
}

function canUpdateQuestion()
{
    $questions = QuestionDB::GetOpenQuestions();
    $question = $questions[0];
    $question->setOpenTime('2017-02-07');
    $question->setCloseTime('2017-02-07');
    $question->setStatus('Closed');
    QuestionDB::UpdateQuestion($question);
    $test = QuestionDB::GetQuestion($question);

    if ($test->getStatus() == 'Closed') {
        echo "<p style='color:green;'>  Update Question question was successful! </p>";
    } else {
        echo "<p style='color:red;'> Update question not successful! </p>";
        echo $test->getOpenTime();
    }

    function canDeleteQuestion()
    {
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

canCreateQuestion();
canGetOpenQuestions();
canGetQuestion();
canUpdateQuestion();
canDeleteQuestion();
