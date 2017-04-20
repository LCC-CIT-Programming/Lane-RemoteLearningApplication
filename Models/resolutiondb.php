<?php

class ResolutionDB
{
    public static function CreateResolution($RESOLUTION)
    {
        $questionID = $RESOLUTION->getQuestionID();
        $userID = $RESOLUTION->getUserID();
        $resolutionText = $RESOLUTION->getResolution();

        $query = 'INSERT INTO Resolution (QuestionId, UserID, Resolution)
                  VALUES (:questionid, :userid, :resolution)';

        $db = Database::getDB();

        $statement = $db->prepare($query);
        $statement->bindValue(":questionid", $questionID);
        $statement->bindValue(":userid", $userID);
        $statement->bindValue(":resolution", $resolutionText);
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

    public static function RetrieveResolutionByID($QUESTIONID)
    {
        $query = 'SELECT *
                  FROM Resolution
                  WHERE QuestionId = :questionid';

        $db = Database::getDB();

        $statement = $db->prepare($query);
        $statement->bindValue(":questionid", $QUESTIONID);
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

    public static function RetrieveUnfinishedResolutions()
    {
        $query = 'SELECT *
                  FROM Resolution
                  WHERE Resolution IS NULL';

        $db = Database::getDB();

        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();

        $resolutions = array();

        if ($rows != null) {
        foreach ($rows as $row) {
            $resolution = new Resolution($row['QuestionId'],
                                         $row['UserID'],
                                         $row['Resolution']);
            array_push($resolutions, $resolution);
        }
            return $resolutions;
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
