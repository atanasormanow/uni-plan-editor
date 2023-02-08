<?php
require_once(__DIR__ . '/../config.php');

function getDatabaseConnection()
{
  $db = new mysqli(Config::$host, Config::$username, Config::$password);

  if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
  }

  return $db;
}
