<?php
include_once('../Models/db.php');
include_once('../Models/schedule.php');
include_once('../Models/scheduledb.php');

function canRetrieveSchedule() {
  $schedule = new Schedule(1, time(), time(20), 5, 1);
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
  $schedule = new Schedule(3, $starttime, $endtime, 5, 5);

   scheduledb::CreateSchedule($schedule);

   echo $schedule->getStartTime();
   echo $schedule-> getEndTime();
  $valid = scheduledb::GetSchedule($schedule);
  if ($valid != null) {
    echo "<p style='color:green;'>Adding the schedule was successful! </p>";
  } else {
    echo "<p style='color:red;'>Adding the schedule was not successful! </p>";
  }
}
//
// function canUpdateCourseByNumber() {
//   $course = new Course('CS 296N', 'test', 2);
//   CourseDB::UpdateCourseByNumber($course);
//   $valid = CourseDB::RetrieveCourse($course);
//
//   if ($valid->getLeadInstructor() == 2) {
//     echo "<p style='color:green;'>Updating the course was successful! </p>";
//   } else {
//     echo "<p style='color:red;'>Updating the course was not successful! </p>";
//   }
// }
//
// function canUpdateCourseByName() {
//   $course = new Course('CS 300', 'test', 2);
//   CourseDB::UpdateCourseByName($course);
//   $valid = CourseDB::RetrieveCourse($course);
//
//   if (($valid->getLeadInstructor() == 2) && ($valid->getCourseNumber() == 'CS 300')) {
//     echo "<p style='color:green;'>Updating the course was successful! </p>";
//   } else {
//     echo "<p style='color:red;'>Updating the course was not successful! </p>";
//   }
// }
//
// function canDeleteCourse() {
//   $course = new Course('CS 300', 'test', 2);
//   CourseDB::DeleteCourse($course);
//
//   $valid = CourseDB::RetrieveCourse($course);
//   if ($valid == null) {
//     echo "<p style='color:green;'>Deleting the course was successful! </p>";
//   } else {
//     echo "<p style='color:red;'>Deleting the course was not successful! </p>";
//   }
// }

canRetrieveSchedule();
canCreateSchedule();
?>
