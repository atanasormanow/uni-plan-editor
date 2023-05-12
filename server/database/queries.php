<?php
require_once(__DIR__ . '/connection.php');
require_once(__DIR__ . '/../model/user.php');

class Queries
{
  public static function createUser($username, $password)
  {
    $db = getDatabaseConnection();
    $username = $db->real_escape_string($username);
    $password = $db->real_escape_string($password);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
    if ($db->query($sql)) {
      // Get the ID of the newly created user
      return new User($db->insert_id, $username, $password);
    } else {
      return false;
    }
  }

  public static function verifyUser($username, $password)
  {
    $db = getDatabaseConnection();
    $username = $db->real_escape_string($username);
    $password = $db->real_escape_string($password);

    $sql = "SELECT id, password FROM users WHERE username = '$username'";
    $result = $db->query($sql);

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);

      (bool)password_verify($password, $row['password']);
    } else {
      return false; // Return false if the user does not exist
    }
  }

  public static function getUserByUsername($username)
  {
    $db = getDatabaseConnection();
    $username = $db->real_escape_string($username);

    $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = $db->query($sql);

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result); // returns the first row in the result?
      // The password should be hasshed here
      return new User($row['id'], $row['username'], $row['password']);
    } else {
      return false; // Return false if the user does not exist
    }
  }

  public static function getAllPlans()
  {
    $db = getDatabaseConnection();
    $result = $db->query("SELECT * FROM subject_plans");
    $rows = array();
    while ($row = $result->fetch_assoc()) {
      $rows[] = $row;
    }
    return json_encode($rows);
  }

  public static function createPlan($name, $owner, $description)
  {
    $db = getDatabaseConnection();
    $name = $db->real_escape_string($name);
    $description = $db->real_escape_string($description);
    $owner = $db->real_escape_string($owner);

    $query = "INSERT INTO subject_plans (name, description, owner) VALUES ('$name', '$description', '$owner')";

    if ($db->query($query)) {
      return new Plan($db->insert_id, $name, $description, $owner);
    } else {
      return false;
    }
  }

  public static function deletePlanById($id)
  {
    $db = getDatabaseConnection();
    $id = $db->real_escape_string($id);

    $sql = "DELETE FROM subject_plans WHERE id = '$id'";

    (bool)$db->query($sql);
  }
}
