<?php
class VisitDB
{
    public static function CreateVisit($VISIT)
    {
    
    	self::EndPreviousVisitForUser($VISIT->getUserID(), $VISIT->getRole());
    
        $db = Database::getDB();

        $userID = $VISIT->getUserID();
        $locationID = $VISIT->getLocationID();
        $startTime = date("Y-m-d H:i:s");
		$lastPing = $startTime;
        $role = $VISIT->getRole();

        $query = 'INSERT INTO Visit
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
			          FROM Visit
                WHERE Visit.UserID = :userid AND Visit.LocationId = :locationid AND Visit.EndTime IS NULL';

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
    
    public static function RetrieveLastVisit($userID, $role)
    {
        $db = Database::getDB();

        $query = 'SELECT *
			        FROM Visit
                	WHERE Visit.UserID = :userid AND
                		Visit.Role = :role AND  
                		Visit.EndTime IS NULL';

        $statement = $db->prepare($query);
        $statement->bindValue(":userid", $userID);
        $statement->bindValue(":role", $role);
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
			          FROM Visit
                WHERE Visit.VisitId = :visitid';

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

        $query = 'UPDATE Visit
            SET LocationId = :locationid, EndTime = :endtime, StartTime = :starttime, LastPing = :lastping
		        WHERE Visit.VisitId = :visitid';

        $statement = $db->prepare($query);
        $statement->bindValue(":locationid", $VISIT->getLocationID());
        $statement->bindValue(":endtime", $VISIT->getEndTime());
        $statement->bindValue(":starttime", $VISIT->getStartTime());
		$statement->bindValue(":lastping", $VISIT->getLastPing());
        $statement->bindValue(":visitid", $VISIT->getVisitID());
        $statement->execute();
        $statement->closeCursor();
    }
    
    public static function EndPreviousVisitForUser($userID, $role)
    {
    	$visit = self::RetrieveLastVisit($userID, $role);
    	if ($visit != null)
    	{
    		$db = Database::getDB();
    		$query = 'UPDATE Visit
            	SET EndTime = :endtime
		        WHERE Visit.VisitId = :visitid AND EndTime IS NULL';
		    $statement = $db->prepare($query);
		    $statement->bindValue(":visitid", $visit->getVisitID());
		    $statement->bindValue(":endtime", $visit->getLastPing());
		    $statement->execute();
        	$statement->closeCursor();
        	$query = 'UPDATE Task
        		SET EndTime = :endtime
        		WHERE Task.VisitId = :visitid AND EndTime IS NULL';
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

        $query = 'DELETE FROM Visit
		          WHERE Visit.VisitId = :visitid';

        $statement = $db->prepare($query);
        $statement->bindValue(":visitid", $VISIT->getVisitID());
        $statement->execute();
        $statement->closeCursor();
    }
}
