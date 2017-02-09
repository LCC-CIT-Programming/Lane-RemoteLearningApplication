<?php

class QuestionDB {

  public static function GetOpenQuestions() {
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
							   $row['QuestionID'],
							   $row['UserID'],
							   $row['CourseNumber'],
                 $row['Subject'],
                 $row['Description'],
                 $row['Status'],
							   $row['AskTime'],
							   $row['OpenTime'],
							   $row['CloseTime']
							   );


          array_push($questions, $question);
      }
      return $questions;
  }

public static function GetQuestion($question) {
      $db = Database::getDB();

      $query = 'SELECT *
			          FROM question
                WHERE question.questionID = :questionId';

      $statement = $db->prepare($query);
	    $questionid = $question->getQuestionID();
      $statement->bindValue(":questionId", $questionid );
      $statement->execute();
      $row = $statement->fetch();
      $statement->closeCursor();

      if ($row != false) {

        $question = new Question(
							   $row['QuestionID'],
							   $row['UserID'],
							   $row['CourseNumber'],
                 $row['Subject'],
                 $row['Description'],
                 $row['Status'],
							   $row['AskTime'],
							   $row['OpenTime'],
							   $row['CloseTime']
							   );
		return $question;
	} else
		return null;
  }

public static function UpdateQuestion($question) {
      $db = Database::getDB();

      $query = 'UPDATE question
                SET status = :status, openTime = :openTime, closeTime = :closeTime
			          WHERE question.questionID = :questionId';

  $statement = $db->prepare($query);
	$status = $question->getStatus();
	$openTime = $question->getOpenTime();
	$closeTime = $question->getCloseTime();
	$questionid = $question->getQuestionID();

  $statement->bindValue(":status", $status );
	$statement->bindValue(":openTime", $openTime );
	$statement->bindValue(":closeTime", $closeTime );
	$statement->bindValue(":questionId", $questionid );
  $statement->execute();
  $statement->closeCursor();

}



  public static function CreateQuestion($question) {
    $db = Database::getDB();

    $studentid = $question->getStudentID();
  	$courseid = $question->getCourseID();
    $subject = $question->getSubject();
    $description = $question->getDescription();
    $status = $question->getStatus();
  	$askTime = date("Y-m-d h:i:s");
  	$openTime = $question->getOpenTime();
  	$closeTime = $question->getCloseTime();

    $query = 'INSERT INTO question
              (userid, coursenumber, subject, description, status, askTime, openTime, closeTime)
              VALUES
              ( :studentid, :courseid,:subject, :description, :status, :askTime, :openTime, :closeTime)';

    $statement = $db->prepare($query);
    $statement->bindValue(':studentid', $studentid);
    $statement->bindValue(':courseid', $courseid);
    $statement->bindValue(':subject', $subject);
    $statement->bindValue(':description', $description);
  	$statement->bindValue(':status', $status);
  	$statement->bindValue(':askTime', $askTime);
  	$statement->bindValue(':openTime', $openTime);
  	$statement->bindValue(':closeTime', $closeTime);
    $statement->execute();
    $statement->closeCursor();
  }

  public static function DeleteQuestion($question) {
    $db = Database::getDB();
    $questionid = $question->getQuestionID();

    $query = 'DELETE FROM question
		          WHERE question.questionID = :questionId';

    $statement = $db->prepare($query);
  	$statement->bindValue(":questionId", $questionid );
    $statement->execute();
    $statement->closeCursor();
  }


}
