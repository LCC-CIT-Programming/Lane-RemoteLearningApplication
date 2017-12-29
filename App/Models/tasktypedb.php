<?php

class TaskTypeDB
{

    public static function GetTaskTypes()
    {
        $query = 'SELECT * FROM TaskType Order By TaskTypeName';

        $db = Database::getDB();

        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();

        $tasktypes = array();

        foreach ($rows as $row) {
            $tasktype = new TaskType($row['TaskTypeId'],
                                     $row['TaskTypeName'], 
                                     $row['TaskTypeCategory']);
            array_push($tasktypes, $tasktype);
        }
        return $tasktypes;
    }
}

?>