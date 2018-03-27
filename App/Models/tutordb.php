<?php
class TutorDB
{
    public static function TutorLogin($USERNAME)
    {
        $query = 'SELECT AppUser.*, TutorBio
								FROM AppUser
								INNER JOIN Tutor
								ON AppUser.UserID = Tutor.UserID
								WHERE AppUser.LNumber = :username';

        $db = Database::getDB();
        $statement = $db->prepare($query);
        $statement->bindValue(":username", $USERNAME);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();
        if ($row != false) {
            $user = new Tutor(
				$row['FirstName'],
				$row['LastName'],
				$row['LNumber'],
				$row['EmailAddress'],
				$row['AppUserBio'],
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
        $email = $tutor->getEmail();
        $tutorBio = $tutor->getTutorBio();
        $bio = $tutor->getBio();

        $query1 = 'INSERT INTO AppUser(FirstName, LastName, LNumber, EmailAddress, AppUserBio)
								 VALUES (:firstName, :lastName, :lnum, :email, :bio)';

        $statement = $db->prepare($query1);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':lnum', $lnum);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':bio', $bio);
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
        $email = $tutor->getEmail();
        $userid = $tutor->getUserID();
        $tutorBio = $tutor->getTutorBio();
        $bio = $tutor->getBio();

        $query1 = 'UPDATE AppUser 
        	SET FirstName=:firstName, LastName=:lastName,  
			EmailAddress=:email, AppUserBio = :bio 
			WHERE UserID = :userid';
		$query2 = 'UPDATE Tutor
			SET TutorBio=:tutorBio
			WHERE UserID=:userid';

        $statement = $db->prepare($query1);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':bio', $bio);
        $statement->bindValue(':userid', $userid);
        if ($statement->execute())
        	$statement->closeCursor();
        else
        	throw new PDOException("Could not update app user table in update tutor");

        $statement = $db->prepare($query2);        
        $statement->bindValue(':tutorBio', $tutorBio);
        $statement->bindValue(':userid', $userid);
        if ($statement->execute())
        	$statement->closeCursor();
        else
        	throw new PDOException("Could not update tutor table in update tutor");
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
				 $row['EmailAddress'],
				 $row['AppUserBio'],
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
            $tutor = new Tutor(
				 $row['FirstName'],
				 $row['LastName'],
				 $row['LNumber'],
				 $row['EmailAddress'],
				 $row['AppUserBio'],
				 $row['TutorBio'],                                                   
				 $row['UserID']);

            return $tutor;
        } else {
            return null;
        }
    }
}
?>
