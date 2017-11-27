<?php
class TaskDB
{
    public static function CreateTask($TASK)
    {
        $db = Database::getDB();

        $visitID = $TASK->getVisitID();
        $courseNumber = $TASK->getCourseNumber();
        $startTime = $TASK->getStartTime();

        $query = 'INSERT INTO task
              (VisitId, Coursenumber, StartTime)
              VALUES
              ( :visitid, :coursenumber,:starttime)';

        $statement = $db->prepare($query);
        $statement->bindValue(':visitid', $visitID);
        $statement->bindValue(':coursenumber', $courseNumber);
        $statement->bindValue(':starttime', $startTime);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function RetrieveTask($TASK)
    {
        $db = Database::getDB();

        $query = 'SELECT *
			          FROM task
                WHERE task.VisitId = :visitid AND task.StartTime = :starttime';

        $statement = $db->prepare($query);
        $statement->bindValue(":visitid", $TASK->getVisitID());
        $statement->bindValue(":starttime", $TASK->getStartTime());
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        if ($row != false) {
            $task = new Task(
                       $row['VisitId'],
                       $row['CourseNumber'],
             $row['StartTime'],
             $row['TaskId'],
             $row['EndTime']);
            return $task;
        } else {
            return null;
        }
    }

    public static function RetrieveTaskByID($TASK)
    {
        $db = Database::getDB();

        $query = 'SELECT *
			          FROM task
                WHERE task.TaskId = :taskid';

        $statement = $db->prepare($query);
        $statement->bindValue(":taskid", $TASK->getTaskID());
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        if ($row != false) {
            $task = new Task(
                                     $row['VisitId'],
                                     $row['CourseNumber'],
                       $row['StartTime'],
                       $row['TaskId'],
                       $row['EndTime']);
            return $task;
        } else {
            return null;
        }
    }

    public static function UpdateTask($TASK)
    {
        $db = Database::getDB();
        $taskID = $TASK->getTaskID();
        $endTime = $TASK->getEndTime();

        $query = 'UPDATE task
            SET EndTime = :endtime
		        WHERE task.TaskId = :taskid';

        $statement = $db->prepare($query);
        $statement->bindValue(":taskid", $taskID);
        $statement->bindValue(":endtime", $endTime);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function DeleteTask($TASK)
    {
        $db = Database::getDB();
        $taskID = $TASK->getTaskID();

        $query = 'DELETE FROM task
		          WHERE task.TaskId = :taskid';

        $statement = $db->prepare($query);
        $statement->bindValue(":taskid", $taskID);
        $statement->execute();
        $statement->closeCursor();
    }
}
