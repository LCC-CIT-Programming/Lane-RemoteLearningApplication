<?php
class TutorDB
{
    public static function TutorLogin($USERNAME, $PASSWORD)
    {
        $query = 'SELECT appuser.*, TutorBio
								FROM appuser
								INNER JOIN tutor
								ON appuser.UserID = tutor.UserID
								WHERE appuser.LNumber = :username
								AND appuser.Password = :password';

        $db = Database::getDB();
        $statement = $db->prepare($query);
        $statement->bindValue(":username", $USERNAME);
        $statement->bindValue(":password", $PASSWORD);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();
        if ($row != false) {
            $user = new Tutor(
                                                        $row['FirstName'],
                                                        $row['LastName'],
                                                        $row['LNumber'],
                                                        $row['Password'],
                                                        $row['EmailAddress'],
                                                        $row['TutorBio'],
                                                        $row['UserID']);
            return $user;
        } else {
            return null;
        }
    }

    public static function CreateTutor($tutor)
    {
        $db = Database::getDB();

        $firstName = $tutor->getFirstName();
        $lastName = $tutor->getLastName();
        $lnum = $tutor->getLnumber();
        $pass = $tutor->getPassword();
        $email = $tutor->getEmail();
        $tutorBio = $tutor->getTutorBio();

        $query1 = 'INSERT INTO AppUser(FirstName, LastName, LNumber, Password, EmailAddress)
								 VALUES (:firstName, :lastName, :lnum, :pass, :email)';

        $statement = $db->prepare($query1);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':lnum', $lnum);
        $statement->bindValue(':pass', $pass);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $statement->closeCursor();

        $query2 = 'SELECT UserID
								 FROM AppUser
								 WHERE LNumber = :lnum';

        $statement = $db->prepare($query2);
        $statement->bindValue(':lnum', $lnum);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();
        $userid = $row['UserID'];

        $query3 = 'INSERT INTO Tutor(UserID, TutorBio)
							VALUES(:userid, :tutorBio)';

        $statement = $db->prepare($query3);
        $statement->bindValue(':userid', $userid);
        $statement->bindValue(':tutorBio', $tutorBio);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function UpdateTutor($tutor)
    {
        $db = Database::getDB();

        $firstName = $tutor->getFirstName();
        $lastName = $tutor->getLastName();
        $lnum = $tutor->getLNumber();
        $pass = $tutor->getPassword();
        $email = $tutor->getEmail();
        $userid = $tutor->getUserID();
        $tutorBio = $tutor->getTutorBio();

        $query = 'UPDATE Appuser
								SET FirstName=:firstName, LastName=:lastName, Lnumber=:lnum, Password=:password, Email=:email, TutorBio=:tutorBio
								WHERE UserID = :userid;
								
								UPDATE Tutor
								SET TutorBio=:tutorBio
								WHERE UserID=:userid';

        $statement = $db-prepare($query);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':lnum', $lnum);
        $statement->bindValue(':pass', $pass);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':tutorBio', $tutorBio);
        $statement->bindValue(':userid', $userid);
        $statement->execute();
        $statement->closeCursor();
    }
        
    public static function UpdateProfile($USER)
    {
        $db = Database::getDB();
        
        $email = $USER->getEmail();
        $pass = $USER->getPassword();
        $userID = $USER->getUserID();
        $summary = $USER->getTutorBio();
    
        $query = 'UPDATE AppUser 
					SET Password = :pass, EmailAddress = :email, TutorBio = :summary
					WHERE UserID = :userid';
                    
        $statement = $db->prepare($query);
        $statement->bindValue(':pass', $pass);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':summary', $summary);
        $statement->bindValue(':userid', $userID);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function DeleteTutor($tutor)
    {
        $db = Database::getDB();
        $userid = $tutor->getUserID();

        $query = 'DELETE FROM Tutor
						WHERE UserID = :userid;

					DELETE FROM Appuser
						WHERE UserID = :userid';

        $statement = $db->prepare($query);
        $statement->bindValue(':userid', $userid);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function GetAllTutors()
    {
        $db = Database::getDB();
        $query = 'SELECT *
								FROM AppUser, Tutor
								WHERE AppUser.UserID = Tutor.UserID';
        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        foreach ($rows as $row) {
            $tutor = new Tutor(
                                                     $row['FirstName'],
                                                     $row['LastName'],
                                                     $row['LNumber'],
                                                     $row['Password'],
                                                     $row['EmailAddress'],
                                                     $row['TutorBio'],
                                                     $row['UserID']);
            $tutors[] = $tutor;
        }
        return $tutors;
    }

    public static function GetOnlineTutors()
    {
        $db = Database::getDB();
        $query = 'SELECT *
									FROM onlinetutors';
        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();

        foreach ($rows as $row) {
            $tutor = TutorDB::RetrieveTutorByID($row['UserID']);
            $tutors[] = $tutor;
        }

        if (isset($tutors)) {
            return $tutors;
        } else {
            return null;
        }
    }

    public static function RetrieveTutorByID($TUTORID)
    {
        $query = 'SELECT *
									FROM AppUser
									JOIN Tutor
									ON AppUser.UserID = Tutor.UserID
									WHERE AppUser.UserID = :userid';
        $db = Database::getDB();
        $statement = $db->prepare($query);
        $statement->bindValue(':userid', $TUTORID);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();
        if ($row != false) {
            $user = new Tutor(
                                                            $row['FirstName'],
                                                            $row['LastName'],
                                                            $row['LNumber'],
                                                            $row['Password'],
                                                            $row['EmailAddress'],
                                                            $row['TutorBio'],
                                                          $row['UserID']);

            return $user;
        } else {
            return null;
        }
    }
}
