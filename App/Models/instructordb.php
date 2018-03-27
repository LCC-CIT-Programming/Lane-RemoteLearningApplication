<?php
class InstructorDB
{
    public static function InstructorLogin($USERNAME)
    {
        $query = 'SELECT * FROM AppUser
					WHERE AppUser.LNumber = :username';

        $db = Database::getDB();
        $statement = $db->prepare($query);
        $statement->bindValue(":username", $USERNAME);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();
        if ($row != false) {
            $user = new Instructor(
				$row['FirstName'],
				$row['LastName'],
				$row['LNumber'],
				$row['EmailAddress'],
				$row['AppUserBio'],
				$row['UserID']);
            return $user;
        } else {
            return null;
        }
    }

    public static function UpdateInstructor($INSTRUCTOR)
    {
        $db = Database::getDB();

        $firstName = $INSTRUCTOR->getFirstName();
        $lastName = $INSTRUCTOR->getLastName();
        $lnum = $INSTRUCTOR->getLNumber();
        $email = $INSTRUCTOR->getEmail();
        $userID = $INSTRUCTOR->getUserID();
        $bio = $INSTRUCTOR->getBio();
        
        $query = 
        	'UPDATE AppUser
				SET FirstName = :firstname, LastName = :lastname,  
				EmailAddress = :email, AppUserBio = :bio
				WHERE UserID = :userid';

        $statement = $db->prepare($query);
        $statement->bindValue(':firstname', $firstName);
        $statement->bindValue(':lastname', $lastName);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':bio', $bio);
        $statement->bindValue(':userid', $userID);
		if ($statement->execute())
			$statement->closeCursor();
		else
			throw new PDOException("Could not update app user in update instructor");
        
    }

    public static function DeleteInstructor($instructor)
    {
        $db = Database::getDB();
        $userid = $instructor->getUserID();

        $query = 'DELETE FROM Appuser
						WHERE UserID = :userid';

        $statement = $db->prepare($query);
        $statement->bindValue(':userid', $userid);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function GetAllnstructors()
    {
        $db = Database::getDB();
        $query = 'SELECT *
								FROM AppUser, Instructor
								WHERE AppUser.UserID = Instructor.UserID';
        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        $instructors = array();
        foreach ($rows as $row) {
            $instructor = new Instructor(
				 $row['FirstName'],
				 $row['LastName'],
				 $row['LNumber'],
				 $row['EmailAddress'],
				 $row['AppUserBio'],                                                   
				 $row['UserID']);
			$instructors[] = $instructor;
        }
        return $tutors;
    }

    public static function RetrieveInstructorByID($INSTRUCTORID)
    {
        $query = 'SELECT *
					FROM AppUser
					WHERE AppUser.UserID = :userid';
        $db = Database::getDB();
        $statement = $db->prepare($query);
        $statement->bindValue(':userid', $TUTORID);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();
        if ($row != false) {
            $instructor = new Instructor(
				 $row['FirstName'],
				 $row['LastName'],
				 $row['LNumber'],
				 $row['EmailAddress'],
				 $row['AppUserBio'],                                                  
				 $row['UserID']);

            return $instructor;
        } else {
            return null;
        }
    }
}
?>