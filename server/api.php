<?php
// header("Access-Control-Allow-Origin: *");

// Connect to MySQL server
$servername = "localhost";
$username = "webcourse";
$password = "";
$db = new mysqli($servername, $username, $password);

if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}

switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    handleGetRequest();
    break;
  case 'POST':
    handlePostRequest();
    break;
  case 'PUT':
    handlePutRequest();
    break;
  case 'DELETE':
    handleDeleteRequest();
    break;
  default:
    http_response_code(405);
    echo "No such method";
    break;
}

// Handle GET request to receive a list of the databases
function handleGetRequest()
{
  global $db;
  $data = json_decode(file_get_contents("php://input"), true);
  // get migration by name
  if (isset($data['migration'])) {
    // escape to avoid SQL injection
    $name = $db->real_escape_string($data['migration']);
    $db->query("USE migration_manager");
    $migration = $db->query("SELECT * FROM migrations WHERE name='$name'")->fetch_assoc();
    echo json_encode($migration);
  // list all databases
  } else {
    $result = $db->query("SHOW DATABASES");
    $databases = array();
    while ($row = $result->fetch_assoc()) {
      $databases[] = $row['Database'];
    }
    echo json_encode($databases);
  }
}

// Handle POST request to create a new database
// TODO: create migration
function handlePostRequest()
{
  global $db, $username;
  $data = json_decode(file_get_contents("php://input"), true);
  $name = $db->real_escape_string($data['name']);
  // prefix database with username to have access rights
  $db->query("CREATE DATABASE " . $username . "_$name");
  echo "Database created";
}

// Handle PUT request to execute a given SQL query on a particular database
// TODO: should be able to run up/down for some migration
function handlePutRequest()
{
  global $db;
  // $data = json_decode(file_get_contents("php://input"), true);
  // $db->query("USE " . $data->database);
  // $db->query($data->query);
  echo "Query executed";
}

// Handle DELETE request to delete a database
function handleDeleteRequest()
{
  global $db, $username;
  $data = json_decode(file_get_contents("php://input"), true);
  $db->query("DROP DATABASE " . $username . "_" . $data['name']);
  echo "Database deleted";
}
