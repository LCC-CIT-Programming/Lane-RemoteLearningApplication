<?php
include_once('../Models/db.php');
include_once('../Models/schedule.php');
include_once('../Models/scheduledb.php');

function canRetrieveSchedule() {
  $schedule = new Schedule(1, time(), time(20), 5, 16);
  $valid = scheduledb::GetSchedule($schedule);

  if ($valid != null) {
    echo "<p style='color:green;'>Retrieving the schedule was successful! </p>";
  } else {
    echo "<p style='color:red;'>Retrieving the schedule was not successful! </p>";
  }
}

function canCreateSchedule() {
  $starttime = date("Y-m-d H:i:s");
  $endtime = date("Y-m-d H:i:s", strtotime('+5 hours'));
  $schedule = new Schedule(3, $starttime, $endtime, 5, 16);
  scheduledb::CreateSchedule($schedule);

  $valid = scheduledb::GetSchedule($schedule);
  if ($valid != null) {
    echo "<p style='color:green;'>Adding the schedule was successful! </p>";
  } else {
    echo "<p style='color:red;'>Adding the schedule was not successful! </p>";
  }
}

function canDeleteSchedule() {
  $starttime = date("Y-m-d H:i:s");
  $endtime = date("Y-m-d H:i:s", strtotime('+5 hours'));
  $schedule = new Schedule(3, $starttime, $endtime, 5, 16);
  scheduledb::DeleteSchedule($schedule);

  $valid = scheduledb::GetSchedule($schedule);
  if ($valid == null) {
    echo "<p style='color:green;'>Deleting the schedule was successful! </p>";
  } else {
    echo "<p style='color:red;'>Deleting the schedule was not successful! </p>";
  }
}

canRetrieveSchedule();
canCreateSchedule();
canDeleteSchedule();
?>
