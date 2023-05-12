<?php
class Plan
{
  private $planId;
  private $name;
  private $description;
  private $owner_id;

  public function __construct($planId, $name, $description, $owner_id)
  {
    $this->planId = $planId;
    $this->name = $name;
    $this->description = $description;
    $this->owner_id = $owner_id;
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
    return $this->owner_id;
  }

  public function setOwner($owner_id)
  {
    $this->owner_id = $owner_id;
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
