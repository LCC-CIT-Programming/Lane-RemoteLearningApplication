<?php
class Question
{
    private $userID;
    private $courseNumber;
    private $questionID;
    private $subject;
    private $description;
    private $status;
    private $askTime;
    private $openTime;
    private $closeTime;

    public function __construct($USERID, $COURSENUMBER, $SUBJECT, $DESCRIPTION, $STATUS, $ASKTIME, $QUESTIONID = null, $OPENTIME = null, $CLOSETIME = null)
    {
        $this->userID = $USERID;
        $this->courseNumber = $COURSENUMBER;
        $this->subject= $SUBJECT;
        $this->description = $DESCRIPTION;
        $this->status = $STATUS;
        $this->askTime = $ASKTIME;
        $this->openTime = $OPENTIME;
        $this->closeTime = $CLOSETIME;
        $this->questionID = $QUESTIONID;
    }

    public function getUserID()
    {
        return $this->userID;
    }


    public function getCourseNumber()
    {
        return $this->courseNumber;
    }


    public function getSubject()
    {
        return $this->subject;
    }



    public function getQuestionID()
    {
        return $this->questionID;
    }



    public function getDescription()
    {
        return $this->description;
    }


    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($VALUE)
    {
        $this->status = $VALUE;
    }

    public function getAskTime()
    {
        return $this->askTime;
    }


    public function setAskTime($VALUE)
    {
        $this->askTime = $VALUE;
    }

    public function getOpenTime()
    {
        return $this->openTime;
    }


    public function setOpenTime($VALUE)
    {
        $this->openTime = $VALUE;
    }

    public function getCloseTime()
    {
        return $this->closeTime;
    }

    public function setCloseTime($VALUE)
    {
        $this->closeTime = $VALUE;
    }

    public static function AskQuestion($COURSENUM, $SUBJECT, $DESCRIPTION)
    {
        $status = "Open";
        $asktime = date("Y-m-d H:i:s");
        
		// ----------- USER -----------  // 
		$user = $_SESSION['user'];
		$userId = $user->GetUserID();

		// ----------- QUESTION -----------  //
		$question = new Question($userId, $COURSENUM, $SUBJECT, $DESCRIPTION, $status, $asktime);
		QuestionDB::CreateQuestion($question);
		
		// ----------- VISIT -----------  //
		$visit = $_SESSION["visit"];
		
		// ----------- TASK -----------  //
		$task = $_SESSION['task'];
		$now = date("Y-m-d H:i:s");
		if (($task !== null) && ($visit !== null)) {
			$elapsedTime = (strtotime($now) - strtotime($task->getStartTime()))/60;
			// has the course changed?
			if ($task->getCourseNumber() !== $COURSENUM) {
				// has the student been working for a while
				if ($elapsedTime > 5) {
					$task->setEndTime(date("Y-m-d H:i:s"));
					taskdb::EndTask($task);
					$startNewTask = new Task($visit->getVisitID(), $COURSENUM, 1, date("Y-m-d H:i:s"));
					TaskDB::CreateTask($startNewTask);
					$task = TaskDB::RetrieveTask($startNewTask);
				}
				// assume he/she means to change the course for the current task
				else {
				    $task->setCourseNumber($COURSENUM);            
               		TaskDB::UpdateTaskContent($task);
				}
				$_SESSION['task'] = $task;
			}
		}
    }

    public function CancelQuestion()
    {
        $this->setStatus('Resolved');
        $this->setCloseTime(date("Y-m-d H:i:s", time()));
        QuestionDB::UpdateQuestion($this);
    }
}
