<?php

$host = "localhost";
$username = "webcourse";
$password = "";

function getDatabaseConnection()
{
  global $host, $username, $password;
  $db = new mysqli($host, $username, $password);

  if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
  }

  return $db;
}
