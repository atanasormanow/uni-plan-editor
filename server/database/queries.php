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

  public static function getPartialPlans()
  {
    $db = getDatabaseConnection();

    $query = "
    SELECT subject_plans.id, name, username AS owner
    FROM `subject_plans`
    LEFT JOIN `users`
    ON subject_plans.owner = users.id;
    ";

    $result = $db->query($query);
    $rows = array();
    while ($row = $result->fetch_assoc()) {
      $rows[] = $row;
    }
    return $rows;
  }

  public static function getPlanDependencies()
  {
    $db = getDatabaseConnection();

    $result = $db->query("SELECT * FROM plans_plans");

    $rows = array();
    while ($row = $result->fetch_assoc()) {
      $rows[] = $row;
    }

    return $rows;
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
    $aquiredSkills,
    $contents,
    $examSynopsis,
    $bibliography,
    $owner,
  ) {
    $db = getDatabaseConnection();

    $type = $db->real_escape_string($type);
    $name = $db->real_escape_string($name);
    $department = $db->real_escape_string($department);
    $busyness = $db->real_escape_string($busyness);
    $credits = $db->real_escape_string($credits);
    $description = $db->real_escape_string($description);
    $requiredSkills = $db->real_escape_string($requiredSkills);
    $aquiredSkills = $db->real_escape_string($aquiredSkills);
    $contents = $db->real_escape_string($contents);
    $examSynopsis = $db->real_escape_string($examSynopsis);
    $bibliography = $db->real_escape_string($bibliography);
    $owner = $db->real_escape_string($owner);
    $targetMajors = implode(',', $targetMajors);

    $owner = Queries::getUserByUsername($owner);
    if (!$owner) {
      return false;
    }

    // TODO
    if (!$department) {
      $department = 'kn';
    }

    $owner_id = $owner->getUserId();

    // TODO: make sure the column types match
    $query = "
    INSERT INTO subject_plans (
    type, target_majors, name, department, busyness, credits,
    description, required_skills, aquired_skills, contents,
    exam_synopsis, bibliography, owner
    ) VALUES (
    '$type', '$targetMajors', '$name', '$department', '$busyness', '$credits',
    '$description', '$requiredSkills', '$aquiredSkills', '$contents',
    '$examSynopsis', '$bibliography', '$owner_id'
    )";

    if ($db->query($query)) {
      return new Plan(
        $db->insert_id,
        $owner_id,
        $type,
        $targetMajors,
        $name,
        $department,
        $busyness,
        $credits,
        $description,
        $requiredSkills,
        $aquiredSkills,
        $contents,
        $examSynopsis,
        $bibliography,
      );
    } else {
      return false;
    }
  }


  public static function editPlan(
    $planId,
    $type,
    $targetMajors,
    $name,
    $department,
    $busyness,
    $credits,
    $description,
    $requiredSkills,
    $aquiredSkills,
    $contents,
    $examSynopsis,
    $bibliography,
    $owner,
  ) {
    $db = getDatabaseConnection();

    $planId = $db->real_escape_string($planId);
    $type = $db->real_escape_string($type);
    $name = $db->real_escape_string($name);
    $department = $db->real_escape_string($department);
    $busyness = $db->real_escape_string($busyness);
    $credits = $db->real_escape_string($credits);
    $description = $db->real_escape_string($description);
    $requiredSkills = $db->real_escape_string($requiredSkills);
    $aquiredSkills = $db->real_escape_string($aquiredSkills);
    $contents = $db->real_escape_string($contents);
    $examSynopsis = $db->real_escape_string($examSynopsis);
    $bibliography = $db->real_escape_string($bibliography);
    $owner = $db->real_escape_string($owner);
    $targetMajors = implode(',', $targetMajors);

    $owner = Queries::getUserByUsername($owner);
    if (!$owner) {
      return false;
    }

    // TODO
    if (!$department) {
      $department = 'kn';
    }

    $owner_id = $owner->getUserId();

    // TODO: make sure the column types match
    $query = "
  UPDATE subject_plans
  SET type='$type', target_majors='$targetMajors', name='$name', department='$department',
  busyness='$busyness', credits='$credits', description='$description', required_skills='$requiredSkills',
  aquired_skills='$aquiredSkills', contents='$contents', exam_synopsis='$examSynopsis',
  bibliography='$bibliography', owner='$owner_id'
  WHERE id='$planId'";

    if ($db->query($query)) {
      return new Plan(
        $planId,
        $owner_id,
        $type,
        $targetMajors,
        $name,
        $department,
        $busyness,
        $credits,
        $description,
        $requiredSkills,
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
    $result = $db->query("SELECT * from subject_plans WHERE id = '$id'");

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);

      return new Plan(
        $row['id'],
        $row['owner'],
        $row['type'],
        $row['target_majors'],
        $row['name'],
        $row['department'],
        $row['busyness'],
        $row['credits'],
        $row['description'],
        $row['required_skills'],
        $row['aquired_skills'],
        $row['contents'],
        $row['exam_synopsis'],
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
