<?php
class User
{
  private $userId;
  private $firstName;
  private $lastName;
  private $password;
  private $status;

  public function __construct($firstName, $lastName, $password, $status)
  {
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->password = $password;
    $this->status = $status;
  }

  public function getFirstName()
  {
    return $this->firstName;
  }

  public function setFirstName($firstName)
  {
    $this->firstName = $firstName;
  }

  public function getLastName()
  {
    return $this->lastName;
  }

  public function setLastName($lastName)
  {
    $this->lastName = $lastName;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function setPassword($password)
  {
    $this->password = $password;
  }

  public function getStatus()
  {
    return $this->status;
  }

  public function setStatus($status)
  {
    $this->status = $status;
  }

  public function getUserId()
  {
    return $this->userId;
  }

  public function setUserId($userId)
  {
    $this->userId = $userId;
  }
}
