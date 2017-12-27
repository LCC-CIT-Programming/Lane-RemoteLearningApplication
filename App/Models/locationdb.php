<?php

class LocationDB
{
    public static function CreateLocation($LOCATION)
    {
        $locationName = $LOCATION->getLocationName();

        $query = 'INSERT INTO LOCATION (LocationName)
              VALUES (:locationName)';

        $db = Database::getDB();

        $statement = $db->prepare($query);

        $statement->bindValue(":locationName", $locationName);

        $statement->execute();
        $statement->closeCursor();
    }

    public static function RetrieveLocationByID($ID)
    {
        $query = 'SELECT *
							FROM Location
              WHERE LocationId = :locationId';

        $db = Database::getDB();

        $statement = $db->prepare($query);
        $statement->bindValue(':locationId', $ID);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        if ($row != false) {
            $location = new Location($row['LocationId'],
                                     $row['LocationName']);

            return $location;
        } else {
            return null;
        }
    }
    
    public static function GetLocations()
    {
        $query = 'SELECT * FROM Location Order By LocationName';

        $db = Database::getDB();

        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();

        $locations = array();

        foreach ($rows as $row) {
            $location = new Location($row['LocationId'],
                                     $row['LocationName']);
            array_push($locations, $location);
        }
        return $locations;
    }
    
    


}