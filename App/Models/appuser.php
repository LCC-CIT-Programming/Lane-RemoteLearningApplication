
<?php
class AppUser
{
    protected $userID;
    protected $firstName;
    protected $lastName;
    protected $lnumber;
    protected $email;

    public function __construct($FIRSTNAME, $LASTNAME, $LNUMBER, $EMAIL, $USERID = null)
    {
        $this->userID = $USERID;
        $this->firstName = $FIRSTNAME;
        $this->lastName = $LASTNAME;
        $this->lnumber = $LNUMBER;
        $this->email = $EMAIL;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }


    public function setFirstName($VALUE)
    {
        $this->firstName = $VALUE;
    }

    public function getLastName()
    {
        return $this->lastName;
    }


    public function setLastName($VALUE)
    {
        $this->lastName = $VALUE;
    }

    public function getLNumber()
    {
        return $this->lnumber;
    }

    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($VALUE)
    {
        $this->email = $VALUE;
    }

    public static function login($LNUMBER, $ROLE)
    {

      $_SESSION['role'] = $ROLE;
      if ($ROLE == "faculty") {
          return null;
      }

      else if ($ROLE == "tutor")
      {
        $user = TutorDB::TutorLogin($LNUMBER);
        if ($user !== null && isset($user)) {
            // ----------- VISIT -----------  //
            $visit = new Visit($user->GetUserID(), 1, $ROLE, date("Y-m-d H:i:s"));
            VisitDB::CreateVisit($visit);
            $visit = VisitDB::RetrieveVisit($visit);
            //SESSION STUFF
            $_SESSION['visit'] = $visit;

            return $user;
        }
      }
      else
      {
        $user = StudentDB::StudentLogin($LNUMBER);

        if ($user !== null && isset($user)) {
            // ----------- COURSES -----------  //
            $courses = StudentDB::GetStudentCourses($user);
			if (count ($courses) == 0)
				return null;
            //SESSION STUFF
            $_SESSION['courses'] = $courses;

            // ----------- VISIT -----------  //
            // assumes the student is working in the lab //
            $visit = new Visit($user->GetUserID(), 1, $ROLE, date("Y-m-d H:i:s"));
            VisitDB::CreateVisit($visit);
            $visit = VisitDB::RetrieveVisit($visit);
            //SESSION STUFF
            $_SESSION['visit'] = $visit;

            // ----------- TASK -----------  //
            // assumes the student is working on first course in the his/her list of courses //
            $task = new Task($visit->getVisitID(), 
            	$courses[0]->getCourseNumber(), 
            	1,
            	date("Y-m-d H:i:s"));
            TaskDB::CreateTask($task);
            $task = TaskDB::RetrieveTask($task);

            //SESSION STUFF
            $_SESSION['task'] = $task;
            return $user;
        }
      }

      $_SESSION['user'] = null;
      return null;
     }
	 
	 // what if the original picture is not a png?  Will browser still display it?
	 public function getImageFilename() {
        $number_hash = md5($this->getLNumber());
		$image_filename = $number_hash . '.png';
        return $image_filename;
    }
    
}

?>
