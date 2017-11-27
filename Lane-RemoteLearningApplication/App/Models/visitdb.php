<?php
class VisitDB
{
    public static function CreateVisit($VISIT)
    {
        $db = Database::getDB();

        $userID = $VISIT->getUserID();
        $locationID = $VISIT->getLocationID();
        $startTime = date("Y-m-d h:i:s");
        $role = $VISIT->getRole();

        $query = 'INSERT INTO visit
              (UserID, LocationId, StartTime, Role)
              VALUES
              ( :userid, :locationid, :starttime, :role )';

        $statement = $db->prepare($query);
        $statement->bindValue(':userid', $userID);
        $statement->bindValue(':locationid', $locationID);
        $statement->bindValue(':starttime', $startTime);
        $statement->bindValue(':role', $role);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function RetrieveVisit($VISIT)
    {
        $db = Database::getDB();

        $query = 'SELECT *
			          FROM visit
                WHERE visit.UserID = :userid AND visit.LocationId = :locationid AND visit.EndTime IS NULL';

        $statement = $db->prepare($query);
        $statement->bindValue(":locationid", $VISIT->getLocationID());
        $statement->bindValue(":userid", $VISIT->getUserID());
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        if ($row != false) {
            $visit = new Visit(
                 $row['UserID'],
                 $row['LocationId'],
                 $row['Role'],
                 $row['VisitId'],
                 $row['StartTime'],
                 $row['EndTime']);
            return $visit;
        } else {
            return null;
        }
    }

    public static function RetrieveVisitByID($VISIT)
    {
        $db = Database::getDB();

        $query = 'SELECT *
			          FROM visit
                WHERE visit.VisitId = :visitid';

        $statement = $db->prepare($query);
        $statement->bindValue(":visitid", $VISIT->getVisitID());
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        if ($row != false) {
            $visit = new Visit(
                       $row['UserID'],
                       $row['LocationId'],
                       $row['Role'],
                       $row['VisitId'],
                       $row['StartTime'],
                       $row['EndTime']);
            return $visit;
        } else {
            return null;
        }
    }

    public static function UpdateVisit($VISIT)
    {
        $db = Database::getDB();

        $query = 'UPDATE visit
            SET LocationId = :locationid, EndTime = :endtime, StartTime = :starttime
		        WHERE visit.VisitId = :visitid';

        $statement = $db->prepare($query);
        $statement->bindValue(":locationid", $VISIT->getLocationID());
        $statement->bindValue(":endtime", $VISIT->getEndTime());
        $statement->bindValue(":starttime", $VISIT->getStartTime());
        $statement->bindValue(":visitid", $VISIT->getVisitID());
        $statement->execute();
        $statement->closeCursor();
    }

    public static function DeleteVisit($VISIT)
    {
        $db = Database::getDB();

        $query = 'DELETE FROM visit
		          WHERE visit.VisitId = :visitid';

        $statement = $db->prepare($query);
        $statement->bindValue(":visitid", $VISIT->getVisitID());
        $statement->execute();
        $statement->closeCursor();
    }
}
