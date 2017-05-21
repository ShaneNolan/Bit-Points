<?php
//Admin Class: User Class + PIN.
class Admin extends User{
  private $pin;

  function __construct($aid,$atype,$aname,$adescription,$apoints,$atpoints,$apin){
    parent::__construct($aid,$atype,$aname,$adescription,$apoints,$atpoints);
    $this->pin = $apin;
  }

  public function getPin(){
    return $this->pin;
  }
}

//User Class: ID, TYPE, NAME, DESCRIPTION, POINTS, TOTAL POINTS.
class User {
  private $id;
  private $name;
  private $type;
  private $description;
  private $points;
  private $totalpoints;

  function __construct($uid,$utype,$uname,$udescription,$upoints,$utpoints){
    $this->id = $uid;
    $this->type = $utype;
    $this->name = $uname;
    $this->description = $udescription;
    $this->setPoints($upoints);
    $this->setTotalPoints($utpoints);
  }

  public function getID(){
    return $this->id;
  }

  public function getType(){
    return $this->type;
  }

  public function getUsername(){
    return $this->name;
  }

  public function getDescription(){
    return $this->description;
  }

  public function getPoints(){
    return $this->points;
  }

  public function setPoints($nPoints){
    $this->points = $nPoints;
  }

  public function getTotalPoints(){
    return $this->totalpoints;
  }

  public function setTotalPoints($nTotalPoints){
    $this->totalpoints = $nTotalPoints;
  }
}
?>
