<?php
include_once('../Models/AppUser.php');

function canConstructAppUser() {
  $user = new AppUser(1, 'test', 'user', 'L00123123', 'testpassword', 'email@email.com');

  if (isset($user)) {
    echo "<p style='color:green;'> Creating an app user was successful! </p>";
  } else {
    echo "<p style='color:red;'> Creating an app user was not successful! </p>";
  }
}

function canGetAppUserID() {
  $user = new AppUser(1, 'test', 'user', 'L00123123', 'testpassword', 'email@email.com');
  if ($user->getUserID() == 1) {
    echo "<p style='color:green;'> Getting the app user id was successful! </p>";
  } else {
    echo "<p style='color:red;'> Getting the app user id was not successful! </p>";
  }
}

// function canSetAppUserID() {
//   $user = new AppUser(1, 'test', 'user', 'L00123123', 'testpassword', 'email@email.com');
//   $user->setUserID(2);
//
//   if ($user->getUserID() == 2) {
//     echo "<p style='color:green;'> Setting the app user's ID was successful! </p>";
//   } else {
//     echo "<p style='color:red;'> Setting the app user's ID was not successful! </p>";
//   }
// }

function canGetAppUserLNumber() {
  $user = new AppUser(1, 'test', 'user', 'L00123123', 'testpassword', 'email@email.com');
  if ($user->getLNumber() == 'L00123123') {
    echo "<p style='color:green;'> Getting the app user's lnumber was successful! </p>";
  } else {
    echo "<p style='color:red;'> Getting the app user's lnumber was not successful! </p>";
    echo $user->getLNumber();
  }
}

// function canSetAppUserLNumber() {
//   $user = new AppUser(1, 'test', 'user', 'L00123123', 'testpassword', 'email@email.com');
//   $user->setLNumber('L00000001');
//
//   if ($user->getLNumber() == 'L00000001') {
//     echo "<p style='color:green;'> Setting the app user's lNumber was successful! </p>";
//   } else {
//     echo "<p style='color:red;'> Setting the app user's lNumber was not successful! </p>";
//   }
// }

function canGetAppUserFirstName() {
  $user = new AppUser(1, 'test', 'user', 'L00123123', 'testpassword', 'email@email.com');

  if ($user->getFirstName() == 'test') {
    echo "<p style='color:green;'> Getting the app user's first name was successful! </p>";
  } else {
    echo "<p style='color:red;'> Getting the app user's first name was not successful! </p>";
  }
}

function canSetAppUserFirstName() {
  $user = new AppUser(1, 'test', 'user', 'L00123123', 'testpassword', 'email@email.com');
  $user->setFirstName('newname');

  if ($user->getFirstName() == 'newname') {
    echo "<p style='color:green;'> Setting the app user's first name was successful! </p>";
  } else {
    echo "<p style='color:red;'> Setting the app user's first name was not successful! </p>";
  }
}

function canGetAppUserLastName() {
  $user = new AppUser(1, 'test', 'user', 'L00123123', 'testpassword', 'email@email.com');

  if ($user->getLastName() == 'user') {
    echo "<p style='color:green;'> Getting the app user's last name was successful! </p>";
  } else {
    echo "<p style='color:red;'> Getting the app user's last name was not successful! </p>";
  }
}

function canSetAppUserLastName() {
  $user = new AppUser(1, 'test', 'user', 'L00123123', 'testpassword', 'email@email.com');
  $user->setLastName('newname');

  if ($user->getLastName() == 'newname') {
    echo "<p style='color:green;'> Setting the app user's last name was successful! </p>";
  } else {
    echo "<p style='color:red;'> Setting the app user's last name was not successful! </p>";
  }
}

function canGetAppUserPassword() {
  $user = new AppUser(1, 'test', 'user', 'L00123123', 'testpassword', 'email@email.com');

  if ($user->getPassword() == 'testpassword') {
    echo "<p style='color:green;'> Getting the app user's password was successful! </p>";
  } else {
    echo "<p style='color:red;'> Getting the app user's password was not successful! </p>";
  }
}

function canSetAppUserPassword() {
  $user = new AppUser(1, 'test', 'user', 'L00123123', 'testpassword', 'email@email.com');
  $user->setPassword('newpassword');

  if ($user->getPassword() == 'newpassword') {
    echo "<p style='color:green;'> Setting the app user's password was successful! </p>";
  } else {
    echo "<p style='color:red;'> Setting the app user's password was not successful! </p>";
  }
}

function canGetAppUserEmail() {
  $user = new AppUser(1, 'test', 'user', 'L00123123', 'testpassword', 'email@email.com');

  if ($user->getEmail() == 'email@email.com') {
    echo "<p style='color:green;'> Getting the app user's email was successful! </p>";
  } else {
    echo "<p style='color:red;'> Getting the app user's email was not successful! </p>";
  }
}

function canSetAppUserEmail() {
  $user = new AppUser(1, 'test', 'user', 'L00123123', 'testpassword', 'email@email.com');
  $user->setEmail('newemail');

  if ($user->getEmail() == 'newemail') {
    echo "<p style='color:green;'> Setting the app user's email was successful! </p>";
  } else {
    echo "<p style='color:red;'> Setting the app user's email was not successful! </p>";
  }
}

canConstructAppUser();
canGetAppUserID();
//canSetAppUserID();
canGetAppUserLNumber();
//canSetAppUserLNumber();
canGetAppUserFirstName();
canSetAppUserFirstName();
canGetAppUserLastName();
canSetAppUserLastName();
canGetAppUserPassword();
canSetAppUserPassword();
canGetAppUserEmail();
canSetAppUserEmail();
?>
