
<?php
class AppUser
{
    protected $userID;
    protected $firstName;
    protected $lastName;
    protected $lnumber;
    protected $pass;
    protected $email;

    public function __construct($FIRSTNAME, $LASTNAME, $LNUMBER, $PASS, $EMAIL, $USERID = null)
    {
        $this->userID = $USERID;
        $this->firstName = $FIRSTNAME;
        $this->lastName = $LASTNAME;
        $this->lnumber = $LNUMBER;
        $this->pass = $PASS;
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

    public function getPassword()
    {
        return $this->pass;
    }


    public function setPassword($VALUE)
    {
        $this->pass = $VALUE;
    }

    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($VALUE)
    {
        $this->email = $VALUE;
    }

    public static function login($LNUMBER, $PASSWORD, $ROLE)
    {

      $_SESSION['role'] = $ROLE;
      if ($ROLE == "faculty") {
          return null;
      }

      else if ($ROLE == "tutor")
      {
        $user = TutorDB::TutorLogin($LNUMBER, $PASSWORD);
        if ($user !== null && isset($user)) {
            // ----------- VISIT -----------  //
            $visit = new Visit($user->GetUserID(), 1, $ROLE, date("Y-m-d h:i:s"));
            VisitDB::CreateVisit($visit);
            $visit = VisitDB::RetrieveVisit($visit);
            //SESSION STUFF
            $_SESSION['visit'] = $visit;

            return $user;
        }
      }
      else
      {
        $user = StudentDB::StudentLogin($LNUMBER, $PASSWORD);

        if ($user !== null && isset($user)) {
            // ----------- COURSES -----------  //
            $courses = StudentDB::GetStudentCourses($user);
            //SESSION STUFF
            $_SESSION['courses'] = $courses;

            // ----------- VISIT -----------  //
            $visit = new Visit($user->GetUserID(), 1, $ROLE, date("Y-m-d h:i:s"));
            VisitDB::CreateVisit($visit);
            $visit = VisitDB::RetrieveVisit($visit);
            //SESSION STUFF
            $_SESSION['visit'] = $visit;

            // ----------- TASK -----------  //
            $task = new Task($visit->getVisitID(), $courses[0]->getCourseNumber(), date("Y-m-d h:i:s"));
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
}
?>
