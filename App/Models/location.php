<?php
class Location
{
    protected $locationID;
    protected $locationName;


    public function __construct($LOCATIONID, $LOCATIONNAME)
    {
        $this->locationID = $LOCATIONID;
       	$this->locationName = $LOCATIONNAME;
    }

    public function getLocationId()
    {
        return $this->locationID;
    }


    public function setLocationId($VALUE)
    {
        $this->locationID = $VALUE;
    }

    public function getLocationName()
    {
        return $this->locationName;
    }


    public function setLocationName($VALUE)
    {
        $this->locationName = $VALUE;
    }
}
?>