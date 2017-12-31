<?php

class MajorDB
{
    public static function CreateMajor($MAJOR)
    {
        $majorName = $MAJOR->getMajorName();

        $query = 'INSERT INTO Major (MajorName)
              VALUES (:majorName)';

        $db = Database::getDB();

        $statement = $db->prepare($query);

        $statement->bindValue(":majorName", $majorName);

        $statement->execute();
        $statement->closeCursor();
    }

    public static function RetrieveMajorByID($ID)
    {
        $query = 'SELECT *
							FROM Major
              WHERE MajorId = :majorId';

        $db = Database::getDB();

        $statement = $db->prepare($query);
        $statement->bindValue(':majorId', $ID);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        if ($row != false) {
            $major = new Major($row['MajorId'], $row['MajorName']);

            return $major;
        } else {
            return null;
        }
    }
    
    public static function GetMajors()
    {
        $query = 'SELECT * FROM Major Order By MajorName';

        $db = Database::getDB();

        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();

        $majors = array();

        foreach ($rows as $row) {
            $major = new Major($row['MajorId'], $row['MajorName']);
            array_push($majors, $major);
        }
        return $majors;
    }
    
    


}