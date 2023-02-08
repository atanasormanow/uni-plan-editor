<?php
require_once(__DIR__ . '/connection.php');
require_once(__DIR__ . '/../config.php');

class DatabaseQueries
{
  // TODO: Exclude the migrations db or changer user perms
  public static function getAllDatabases()
  {
    // TODO? get their tables as well
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
    return json_encode($migration);
  }

  public static function createDatabase($name)
  {
    $username = Config::$username;
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
    $username = Config::$username;
    $db = getDatabaseConnection();
    $query = $db->prepare("DROP DATABASE ?_?");
    $query->bind_param("ss", $username, $name);
    $query->execute();
  }
}
