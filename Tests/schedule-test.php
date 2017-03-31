<?php
include_once('../Models/schedule.php');

function canConstructSchedule() {
  $schedule = new Schedule(1, time(), time(20), 5);

  if (isset($schedule)) {
    echo "<p style='color:green;'> Creating a schedule was successful! </p>";
  } else {
    echo "<p style='color:red;'> Creating a schedule was not successful! </p>";
  }
}

function canGetTutorID() {
  $schedule = new Schedule(1, time(), time(20), 5);
  if ($schedule->getUserID() == 1) {
    echo "<p style='color:green;'> Getting the tutor id was successful! </p>";
  } else {
    echo "<p style='color:red;'> Getting the tutor id was not successful! </p>";
  }
}

function canGetStartTime() {
  $schedule = new Schedule(1, time(), time(20), 5);
  if ($schedule->getStartTime() == time()) {
    echo "<p style='color:green;'> Getting the start time was successful! </p>";
  } else {
    echo "<p style='color:red;'> Getting the start time was not successful! </p>";
  }
}

function canGetEndTime() {
  $schedule = new Schedule(1, time(), time(20), 5);
  if ($schedule->getEndTime() == time(20)) {
    echo "<p style='color:green;'> Getting the end time was successful! </p>";
  } else {
    echo "<p style='color:red;'> Getting the end time was not successful! </p>";
  }
}

function canGetWeekDay() {
  $schedule = new Schedule(1, time(), time(20), 5);
  if ($schedule->getWeekDay() == 5) {
    echo "<p style='color:green;'> Getting the week day was successful! </p>";
  } else {
    echo "<p style='color:red;'> Getting the week day was not successful! </p>";
  }
}

function canGetStringWeekDay() {
  $schedule = new Schedule(1, time(), time(20), 5);
  if ($schedule->getStringWeekDay() == 'Friday') {
    echo "<p style='color:green;'> Getting the string week day was successful! </p>";
  } else {
    echo "<p style='color:red;'> Getting the string week day was not successful! </p>";
  }
}

canConstructSchedule();
canGetTutorID();
canGetStartTime();
canGetEndTime();
canGetWeekDay();
canGetStringWeekDay();
?>
