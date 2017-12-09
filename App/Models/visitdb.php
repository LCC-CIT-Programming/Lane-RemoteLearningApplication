<?php
class VisitDB
{
    public static function CreateVisit($VISIT)
    {
    
    	self::EndPreviousVisitForUser($VISIT->getUserID());
    
        $db = Database::getDB();

        $userID = $VISIT->getUserID();
        $locationID = $VISIT->getLocationID();
        $startTime = date("Y-m-d h:i:s");
		$lastPing = $startTime;
        $role = $VISIT->getRole();

        $query = 'INSERT INTO visit
              (UserID, LocationId, StartTime, LastPing, Role)
              VALUES
              ( :userid, :locationid, :starttime, :lastPing, :role )';
		
			  
        $statement = $db->prepare($query);
        $statement->bindValue(':userid', $userID);
        $statement->bindValue(':locationid', $locationID);
        $statement->bindValue(':starttime', $startTime);
		$statement->bindValue(':lastPing', $lastPing);
        $statement->bindValue(':role', $role);
        $statement->execute();
        $statement->closeCursor();
		
			
		$rows = $statement->rowCount();

		if($rows != 1)
		{
			throw new PDOException("Could not create the visit");
		}
		
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
                 $row['EndTime'],
				 $row['LastPing']);
            return $visit;
        } else {
            return null;
        }
    }
    
    public static function RetrieveLastVisit($userID)
    {
        $db = Database::getDB();

        $query = 'SELECT *
			          FROM visit
                WHERE visit.UserID = :userid AND visit.EndTime IS NULL';

        $statement = $db->prepare($query);
        $statement->bindValue(":userid", $userID);
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
                 $row['EndTime'],
				 $row['LastPing']);
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
                       $row['EndTime'],
					   $row['LastPing']);
            return $visit;
        } else {
            return null;
        }
    }

    public static function UpdateVisit($VISIT)
    {
        $db = Database::getDB();

        $query = 'UPDATE visit
            SET LocationId = :locationid, EndTime = :endtime, StartTime = :starttime, LastPing = :lastping
		        WHERE visit.VisitId = :visitid';

        $statement = $db->prepare($query);
        $statement->bindValue(":locationid", $VISIT->getLocationID());
        $statement->bindValue(":endtime", $VISIT->getEndTime());
        $statement->bindValue(":starttime", $VISIT->getStartTime());
		$statement->bindValue(":lastping", $VISIT->getLastPing());
        $statement->bindValue(":visitid", $VISIT->getVisitID());
        $statement->execute();
        $statement->closeCursor();
    }
    
    public static function EndPreviousVisitForUser($userID)
    {
    	$visit = self::RetrieveLastVisit($userID);
    	if ($visit != null)
    	{
    		$db = Database::getDB();
    		$query = 'UPDATE visit
            	SET EndTime = :endtime
		        WHERE visit.VisitId = :visitid AND EndTime IS NULL';
		    $statement = $db->prepare($query);
		    $statement->bindValue(":visitid", $visit->getVisitID());
		    $statement->bindValue(":endtime", $visit->getLastPing());
		    $statement->execute();
        	$statement->closeCursor();
        	$query = 'UPDATE task
        		SET EndTime = :endtime
        		WHERE task.VisitId = :visitid AND EndTime IS NULL';
        	$statement = $db->prepare($query);
        	$statement->bindValue(":visitid", $visit->getVisitID());
		    $statement->bindValue(":endtime", $visit->getLastPing());
		    $statement->execute();
        	$statement->closeCursor();
    	}
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
