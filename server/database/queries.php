<?php
require_once(__DIR__ . '/connection.php');
require_once(__DIR__ . '/../model/user.php');
require_once(__DIR__ . '/../model/plan.php');

// NOTE: This is used like a module of functions
class Queries
{

  public static function getAllUsers()
  {
    $db = getDatabaseConnection();

    if ($db->query("SELECT * FROM users")) {
    } else {
      return false;
    }
  }

  public static function createUser($username, $password)
  {
    $db = getDatabaseConnection();
    $username = $db->real_escape_string($username);
    $password = $db->real_escape_string($password);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
    if ($db->query($sql)) {
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
      return false;
    }
  }

  public static function getUserById($id)
  {
    $db = getDatabaseConnection();
    $id = $db->real_escape_string($id);
    $result = $db->query("SELECT * FROM users WHERE id = '$id'");

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      return new User($row['id'], $row['username'], $row['password']);
    } else {
      return false;
    }
  }

  public static function getUserByUsername($username)
  {
    $db = getDatabaseConnection();
    $username = $db->real_escape_string($username);

    $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = $db->query($sql);

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);

      // The password should be hasshed here
      return new User($row['id'], $row['username'], $row['password']);
    } else {
      return false;
    }
  }

  public static function getAllPlans()
  {
    $db = getDatabaseConnection();

    $query = "
    SELECT subject_plans.id, name, description, username AS owner
    FROM `subject_plans`
    LEFT JOIN `users`
    ON subject_plans.owner = users.id;
    ";

    $result = $db->query($query);
    $rows = array();
    while ($row = $result->fetch_assoc()) {
      $rows[] = $row;
    }
    return json_encode($rows);
  }

  public static function createPlan(
    $type,
    $targetMajors,
    $name,
    $department,
    $busyness,
    $credits,
    $description,
    $requiredSkills,
    $dependencies,
    $aquiredSkills,
    $contents,
    $examSynopsis,
    $bibliography,
    $owner,
  ) {
    $db = getDatabaseConnection();

    $type = $db->real_escape_string($type);
    $targetMajors = $db->real_escape_string($targetMajors);
    $name = $db->real_escape_string($name);
    $department = $db->real_escape_string($department);
    $busyness = $db->real_escape_string($busyness);
    $credits = $db->real_escape_string($credits);
    $description = $db->real_escape_string($description);
    $requiredSkills = $db->real_escape_string($requiredSkills);
    $dependencies = $db->real_escape_string($dependencies);
    $aquiredSkills = $db->real_escape_string($aquiredSkills);
    $contents = $db->real_escape_string($contents);
    $examSynopsis = $db->real_escape_string($examSynopsis);
    $bibliography = $db->real_escape_string($bibliography);
    $owner = $db->real_escape_string($owner);

    $owner = Queries::getUserByUsername($owner);
    if (!$owner) {
      return false;
    }

    $owner_id = $owner->getUserId();

    // TODO: make sure the column types match
    $query = "
    INSERT INTO subject_plans (
    type, targetMajors, name, department, owner_id, busyness, credits,
    description, requiredSkills, dependencies, aquiredSkills, contents,
    examSynopsis, bibliography, owner
    ) VALUES (
    '$type', '$targetMajors', '$name', '$department', '$busyness', '$credits',
    '$description', '$requiredSkills', '$dependencies', '$aquiredSkills', '$contents',
    '$examSynopsis', '$bibliography', '$owner'
    )";

    if ($db->query($query)) {
      return new Plan(
        $db->insert_id,
        $type,
        $targetMajors,
        $name,
        $department,
        $owner_id,
        $busyness,
        $credits,
        $description,
        $requiredSkills,
        $dependencies,
        $aquiredSkills,
        $contents,
        $examSynopsis,
        $bibliography,
      );
    } else {
      return false;
    }
  }

  public static function getPlanById($id)
  {
    $db = getDatabaseConnection();
    $id = $db->real_escape_string($id);
    $result = $db->query("SELECT * from subject_plans WHERE id = '$id' ");

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      return new Plan(
        $row['id'],
        $row['type'],
        $row['targetMajors'],
        $row['name'],
        $row['department'],
        $row['owner_id'],
        $row['busyness'],
        $row['credits'],
        $row['description'],
        $row['requiredSkills'],
        $row['dependencies'],
        $row['aquiredSkills'],
        $row['contents'],
        $row['examSynopsis'],
        $row['bibliography'],
      );
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
