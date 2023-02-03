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
echo "Connected successfully!";

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
// TODO: handle other get requests
function handleGetRequest() {
  global $db;
  $result = $db->query("SHOW DATABASES");
  $databases = array();
  while ($row = $result->fetch_assoc()) {
    $databases[] = $row['Database'];
  }
  echo json_encode($databases);
}

// Handle POST request to create a new database
function handlePostRequest() {
  global $db, $username;
  $data = json_decode(file_get_contents("php://input"), true);
  // prefix database with username as it has full access to such tables
  $db->query("CREATE DATABASE " . $username . "_" . $data['name']);
  echo "Database created";
}

// Handle PUT request to execute a given SQL query on a particular database
// WIP: should use query template that is stored in a .json
function handlePutRequest() {
  global $db;
  $data = json_decode(file_get_contents("php://input"), true);
  $db->query("USE " . $data->database);
  $db->query($data->query);
  echo "Query executed";
}

// Handle DELETE request to delete a database
function handleDeleteRequest() {
  global $db, $username;
  $data = json_decode(file_get_contents("php://input"), true);
  $db->query("DROP DATABASE " . $username . "_" . $data['name']);
  echo "Database deleted";
}
