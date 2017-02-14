<?php
include_once('../Models/visit.php');
include_once('../Models/visitdb.php');
include_once('../Models/db.php');

function canCreateVisit() {
  $visit = new Visit(10, 6, 1, date("Y-m-d h:i:s"));
  try {
    visitdb::CreateVisit($visit);
    echo "<p style='color:green;'> Creating a visit was successful! </p>";
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
}

function canRetrieveVisit() {
  $visit = new Visit(1, 10, 1, date("Y-m-d h:i:s"));
  $retrievedvisit = visitdb::RetrieveVisit($visit);

  if ($retrievedvisit->getUserID() == 5) {
    echo "<p style='color:green;'> Retrieving a visit was successful! </p>";
  } else {
    echo "<p style='color:red;'> Retrieving a visit was not successful! </p>";
  }
}

function canUpdateVisit() {
  $visit = new Visit(1, 6, 2, date("Y-m-d h:i:s"));
  visitdb::UpdateVisit($visit);
  $retrievedvisit = visitdb::RetrieveVisit($visit);

  if ($retrievedvisit->getLocationID() == 2) {
    echo "<p style='color:green;'> Updating a visit was successful! </p>";
  } else {
    echo "<p style='color:red;'> Updating a visit was not successful! </p>";
  }
}

function canDeleteVisit() {
  $visit = new Visit(16, 10, 1, date("Y-m-d h:i:s"));
  visitdb::DeleteVisit($visit);
  $retrievedvisit = visitdb::RetrieveVisit($visit);

  if ($retrievedvisit == null) {
    echo "<p style='color:green;'> Deleting a visit was successful! </p>";
  } else {
    echo "<p style='color:red;'> Deleting a visit was not successful! </p>";
  }
}

canCreateVisit();
canRetrieveVisit();
canUpdateVisit();
canDeleteVisit();
 ?>
