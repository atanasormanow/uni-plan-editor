<?php
class Plan
{
  private $planId;
  private $name;
  private $description;
  private $owner;

  public function __construct($planId, $name, $description, $owner)
  {
    $this->planId = $planId;
    $this->name = $name;
    $this->description = $description;
    $this->owner = $owner;
  }

  public function getPlanId()
  {
    return $this->planId;
  }

  public function setPlanId($planId)
  {
    $this->planId = $planId;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function getOwner()
  {
    return $this->owner;
  }

  public function setOwner($owner)
  {
    $this->owner = $owner;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function setDescription($description)
  {
    $this->description = $description;
  }
}
