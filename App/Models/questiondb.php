<?php

class QuestionDB
{
    public static function GetOpenQuestions()
    {
        $db = Database::getDB();

        $query = 'SELECT *
			    FROM question
                WHERE question.Status = "Open"
                ORDER BY askTime';

        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();

        $questions = array();
        foreach ($rows as $row) {
            $question = new Question(
                 $row['UserID'],
                 $row['CourseNumber'],
                 $row['Subject'],
                 $row['Description'],
                 $row['Status'],
                 $row['AskTime'],
                 $row['QuestionID'],
                 $row['OpenTime'],
                 $row['CloseTime']);

            array_push($questions, $question);
        }
        return $questions;
    }

    public static function GetQuestion($QUESTION)
    {
        $db = Database::getDB();

        $query = 'SELECT *
			          FROM question
                WHERE Question.QuestionID = :questionid';

        $statement = $db->prepare($query);
        $questionID = $QUESTION->getQuestionID();
        $statement->bindValue(":questionid", $questionID);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        if ($row != false) {
            $question = new Question(
                         $row['UserID'],
                         $row['CourseNumber'],
                         $row['Subject'],
                         $row['Description'],
                         $row['Status'],
                         $row['AskTime'],
                         $row['QuestionID'],
                         $row['OpenTime'],
                         $row['CloseTime']);
            return $question;
        } else {
            return null;
        }
    }
    public static function GetQuestionByID($QUESTION_ID)
    {
        $db = Database::getDB();

        $query = 'SELECT *
  			      FROM question
                  WHERE Question.QuestionID = :questionid';

        $statement = $db->prepare($query);
        $statement->bindValue(":questionid", $QUESTION_ID);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        if ($row != false) {
            $question = new Question(
                   $row['UserID'],
                   $row['CourseNumber'],
                   $row['Subject'],
                   $row['Description'],
                   $row['Status'],
                   $row['AskTime'],
                   $row['QuestionID'],
                   $row['OpenTime'],
                   $row['CloseTime']);
            return $question;
        } else {
            return null;
        }
    }


    public static function UpdateQuestion($QUESTION)
    {
        $db = Database::getDB();

        $query = 'UPDATE question
                SET status = :status, openTime = :openTime, closeTime = :closeTime
			          WHERE question.questionID = :questionid';

        $statement = $db->prepare($query);
        $status = $QUESTION->getStatus();
        $openTime = $QUESTION->getOpenTime();
        $closeTime = $QUESTION->getCloseTime();
        $questionID = $QUESTION->getQuestionID();
        $statement->bindValue(":status", $status);
        $statement->bindValue(":openTime", $openTime);
        $statement->bindValue(":closeTime", $closeTime);
        $statement->bindValue(":questionid", $questionID);
        $statement->execute();
        $statement->closeCursor();
    }


    public static function CreateQuestion($QUESTION)
    {
        $db = Database::getDB();

        $userID = $QUESTION->getUserID();
        $courseNumber = $QUESTION->getCourseNumber();
        $subject = $QUESTION->getSubject();
        $description = $QUESTION->getDescription();
        $status = $QUESTION->getStatus();
        $askTime = date("Y-m-d h:i:s");
        $openTime = $QUESTION->getOpenTime();
        $closeTime = $QUESTION->getCloseTime();

        $query = 'INSERT INTO question
              (userid, coursenumber, subject, description, status, askTime, openTime, closeTime)
              VALUES
              ( :userid, :coursenumber,:subject, :description, :status, :asktime, :opentime, :closetime)';

        $statement = $db->prepare($query);
        $statement->bindValue(':userid', $userID);
        $statement->bindValue(':coursenumber', $courseNumber);
        $statement->bindValue(':subject', $subject);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':status', $status);
        $statement->bindValue(':asktime', $askTime);
        $statement->bindValue(':opentime', $openTime);
        $statement->bindValue(':closetime', $closeTime);
        $statement->execute();
        $statement->closeCursor();
    }


    public static function DeleteQuestion($QUESTION)
    {
        $db = Database::getDB();
        $questionID = $QUESTION->getQuestionID();

        $query = 'DELETE FROM question
		          WHERE question.questionID = :questionid';

        $statement = $db->prepare($query);
        $statement->bindValue(":questionid", $questionID);
        $statement->execute();
        $statement->closeCursor();
    }
}
