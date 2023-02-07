<?php
require_once('../database/connection.php');

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

  public static function getMigration($migration_name)
  {
    $db = getDatabaseConnection();
    $db->query("USE migration_manager");
    $query = $db->prepare("SELECT * FROM migrations WHERE name=?");
    $query->bind_param("s", $migration_name);
    $query->execute();
    $migration = $query->get_result()->fetch_assoc();
    echo json_encode($migration);
  }

  public static function createDatabase($name)
  {
    global $username;
    $db = getDatabaseConnection();
    $query = $db->prepare("CREATE DATABASE ?_?");
    $query->bind_param("ss", $username, $name);
    $query->execute();
  }

  public static function createMigration($migration_name, $db_name, $up, $down)
  {
    $db = getDatabaseConnection();
    $db->query("USE migration_manager");
    $query = $db->prepare("
    INSERT INTO migrations (name, db_name, up, down)
    VALUES (?, ?, ?, ?)
    ");
    $query->bind_param("ssss", $migration_name, $db_name, $up, $down);
    $query->execute();
  }

  public static function deleteDatabase($name)
  {
    global $username;
    $db = getDatabaseConnection();
    $query = $db->prepare("DROP DATABASE ?_?");
    $query->bind_param("ss", $username, $name);
    $query->execute();
  }
}
