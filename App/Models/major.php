<?php
class Major
{
    protected $majorID;
    protected $majorName;


    public function __construct($MAJORID, $MAJORNAME)
    {
        $this->majorID = $MAJORID;
       	$this->majorName = $MAJORNAME;
    }

    public function getMajorId()
    {
        return $this->majorID;
    }


    public function setMajorId($VALUE)
    {
        $this->majorID = $VALUE;
    }

    public function getMajorName()
    {
        return $this->majorName;
    }


    public function setMajorName($VALUE)
    {
        $this->majorName = $VALUE;
    }
}
?>