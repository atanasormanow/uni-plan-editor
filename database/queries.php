<?php
require_once('../database/connection.php' );

// TODO: Maybe import this from somewhere instead
$username = "webcourse";

class DatabaseQueries
{
  public static function getAllDatabases()
  {
    // TODO: maybe do this at top level somehow
    $db = getDatabaseConnection();
    $result = $db->query("SHOW DATABASES");
    $databases = array();
    while ($row = $result->fetch_assoc()) {
      $databases[] = $row['Database'];
    }
    return json_encode($databases);
  }

  public static function getMigration($name)
  {
    $db = getDatabaseConnection();
    $db->query("USE migration_manager");
    $migration = $db->query("SELECT * FROM migrations WHERE name='$name'")->fetch_assoc();
    echo json_encode($migration);
  }

  public static function createDatabase($name)
  {
    global $username;
    $db = getDatabaseConnection();
    $db->query("CREATE DATABASE " . $username . "_$name");
  }

  public static function deleteDatabase($name) {
    global $username;
    $db = getDatabaseConnection();
    $db->query("DROP DATABASE " . $username . "_$name");
  }
}
