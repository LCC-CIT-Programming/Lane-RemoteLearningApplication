<?php

class ResolutionDB
{
    public static function CreateResolution($RESOLUTION)
    {
        $questionID = $RESOLUTION->getQuestionID();
        $userID = $RESOLUTION->getUserID();
        $resolution = $RESOLUTION->getResolution();

        $query = 'INSERT INTO Resolution
                  VALUES (:questionid, :userid, :resolution)';

        $db = Database::getDB();

        $statement = $db->prepare($query);

        $statement->bindValue(":questionid", $questionID);
        $statement->bindValue(":userid", $userID);
        $statement->bindValue(":resolution", $resolution);

        $statement->execute();
        $statement->closeCursor();
    }

    public static function RetrieveResolution($RESOLUTION)
    {
        $questionID = $RESOLUTION->getQuestionID();

        $query = 'SELECT *
                  FROM Resolution
                  WHERE QuestionId = :questionid';

        $db = Database::getDB();

        $statement = $db->prepare($query);
        $statement->bindValue(":questionid", $questionID);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        if ($row != false) {
            $resolution = new Resolution($row['QuestionId'],
                                         $row['UserID'],
                                         $row['Resolution']);
            return $resolution;
        } else {
            return null;
        }
    }

    public static function UpdateResolution($RESOLUTION)
    {
        $questionID = $RESOLUTION->getQuestionID();
        $userID = $RESOLUTION->getUserID();
        $resolution = $RESOLUTION->getResolution();

        $query = 'UPDATE Resolution
                  SET UserID = :userid, Resolution = :resolution
                  WHERE QuestionId = :questionid';

        $db = Database::getDB();

        $statement = $db->prepare($query);
        $statement->bindValue(':questionid', $questionID);
        $statement->bindValue(':userid', $userID);
        $statement->bindValue(':resolution', $resolution);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function DeleteResolution($RESOLUTION)
    {
      $questionID = $RESOLUTION->getQuestionID();

      $query = 'DELETE FROM Resolution
                WHERE QuestionId = :questionid';

        $db = Database::getDB();

        $statement = $db->prepare($query);
        $statement->bindValue(':questionid', $questionID);
        $statement->execute();
        $statement->closeCursor();
    }
}
