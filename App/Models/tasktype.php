<?php
class TaskType
{
    protected $taskTypeID;
    protected $taskTypeName;
    protected $taskTypeCategory;


    public function __construct($TASKTYPEID, $TASKTYPENAME, $TASKTYPECATEGORY = null)
    {
        $this->taskTypeID = $TASKTYPEID;
       	$this->taskTypeName = $TASKTYPENAME;
       	$this->taskTypeCategory = $TASKTYPECATEGORY;
    }
       	
    public function getTaskTypeId()
    {
        return $this->taskTypeID;
    }


    public function setTaskTypeId($VALUE)
    {
        $this->taskTypeID = $VALUE;
    }

    public function getTaskTypeName()
    {
        return $this->taskTypeName;
    }


    public function setTaskTypeName($VALUE)
    {
        $this->taskTypeName = $VALUE;
    }
    
    public function getTaskTypeCategory()
    {
        return $this->taskTypeCategory;
    }


    public function setTaskTypeCategory($VALUE)
    {
        $this->taskTypeCategory = $VALUE;
    }
}
?>