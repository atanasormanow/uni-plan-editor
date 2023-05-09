<?php
require_once(__DIR__ . '/connection.php');
require_once(__DIR__ . '/../config.php');

class Queries
{
  public static function createUser($username, $password)
  {
    $db = getDatabaseConnection();
    $username = $db->real_escape_string($username);
    $password = $db->real_escape_string($password);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
    if ($db->query($sql)) {
      return $db->insert_id; // Get the ID of the newly created user
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

      if (password_verify($password, $row['password'])) {
        return $row['id']; // Return the user's ID if the password is correct
      } else {
        return false; // Return false if the password is incorrect
      }
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

  public static function createPlan($name, $description, $owner)
  {
    $db = getDatabaseConnection();
    $name = $db->real_escape_string($name);
    $description = $db->real_escape_string($description);
    $owner = $db->real_escape_string($owner);

    $query = "INSERT INTO subject_plans (name, description, owner) VALUES ('$name', '$description', '$owner')";

    if ($db->query($query)) {
      $plan_id = $db->insert_id;
      return $plan_id;
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
