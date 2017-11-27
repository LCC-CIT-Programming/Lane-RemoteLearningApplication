<?php
class ScheduleDB
{
    public static function GetSchedule($SCHEDULE)
    {
        $db = Database::getDB();
        $query = 'SELECT *
			          FROM schedule
                WHERE schedule.ScheduleID = :scheduleid';
        $statement = $db->prepare($query);
        $scheduleID = $SCHEDULE->getScheduleID();
        $statement->bindValue(":scheduleid", $scheduleID);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();
        if ($row != false) {
            $schedule = new Schedule(
                                  $row['UserID'],
                    $row['StartTime'],
                    $row['EndTime'],
                    $row['WeekDay'],
                    $row['ScheduleID']);
            return $schedule;
        } else {
            return null;
        }
    }

    public static function GetAllSchedules()
    {
        $db = Database::getDB();
        $query = 'SELECT *
			    FROM schedule';

        $statement = $db->prepare($query);
    //  $scheduleID = $SCHEDULE->getScheduleID();
    //  $statement->bindValue(":scheduleid", $scheduleID );
      $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();

        if ($rows != false) {
            $schedule = array();
            foreach ($rows as $row) {
                $shift = new Schedule(
                        $row['UserID'],
                        $row['StartTime'],
                        $row['EndTime'],
                        $row['WeekDay'],
                        $row['ScheduleID']);

                array_push($schedule, $shift);
            }
            return $schedule;
        } else {
            return null;
        }
    }

    public static function CreateSchedule($SCHEDULE)
    {
        $db = Database::getDB();
        $userID = $SCHEDULE->getUserID();
        $startTime = $SCHEDULE->getStartTime();
        $endTime = $SCHEDULE->getEndTime();
        $weekDay = $SCHEDULE->getWeekDay();
        $query = 'INSERT INTO schedule
              (UserID, StartTime, EndTime, WeekDay)
              VALUES
              ( :userid, :starttime,:endtime, :weekday )';
        $statement = $db->prepare($query);
        $statement->bindValue(':userid', $userID);
        $statement->bindValue(':starttime', $startTime);
        $statement->bindValue(':endtime', $endTime);
        $statement->bindValue(':weekday', $weekDay);
        $statement->execute();
        $statement->closeCursor();
    }
    public static function DeleteSchedule($SCHEDULE)
    {
        $db = Database::getDB();
        $scheduleID = $SCHEDULE->getScheduleID();
        $query = 'DELETE FROM schedule
		          WHERE schedule.ScheduleID = :scheduleid';
        $statement = $db->prepare($query);
        $statement->bindValue(":scheduleid", $scheduleID);
        $statement->execute();
        $statement->closeCursor();
    }
    public static function GetTutorSchedule($TUTOR)
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM schedule
  							JOIN Tutor ON schedule.UserID = tutor.UserID
  				  		WHERE tutor.UserID = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $TUTOR->getUserID());
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        $schedules = array();
        if ($rows != false) {
            foreach ($rows as $row) {
                $schedule = new Schedule($row['UserID'],
                                                                 $row['StartTime'],
                                                                 $row['EndTime'],
                                                               $row['WeekDay'],
                                   $row['ScheduleID']);
                if ($row != false) {
                    array_push($schedules, $schedule);
                }
            }
            return $schedules;
        } else {
            return null;
        }
    }
}
