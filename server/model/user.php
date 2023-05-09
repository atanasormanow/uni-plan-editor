<?php
class User
{
  private $userId;
  private $username;
  private $password;

  public function __construct($userId, $username, $password)
  {
    $this->userId = $userId;
    $this->username = $username;
    $this->password = $password;
  }

  public function getUsername()
  {
    return $this->username;
  }

  public function setUsername($username)
  {
    return $this->username = $username;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function setPassword($password)
  {
    $this->password = $password;
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
