<?php
require_once('../database/connection.php');
require_once('../database/queries.php' );
// header("Access-Control-Allow-Origin: *");

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
  $data = json_decode(file_get_contents("php://input"), true);
  if (isset($data['migration'])) {
    DatabaseQueries::getMigration($data['migration']);
  } else {
    DatabaseQueries::getAllDatabases();
  }
}

// Handle POST request to create a new database
// TODO: create migration
function handlePostRequest()
{
  $data = json_decode(file_get_contents("php://input"), true);
  if (isset($data['name'])) {
    DatabaseQueries::createDatabase($data['name']);
  } else {
    throw new PDOException("Request parameter is missing!");
  }
}

// Handle PUT request to execute a given SQL query on a particular database
// TODO: should be able to run up/down for some migration
function handlePutRequest()
{
  // global $db;
  // $data = json_decode(file_get_contents("php://input"), true);
  // $db->query("USE " . $data->database);
  // $db->query($data->query);
}

// Handle DELETE request to delete a database
function handleDeleteRequest()
{
  $data = json_decode(file_get_contents("php://input"), true);
  if (isset($data['name'])) {
    DatabaseQueries::deleteDatabase($data['name']);
  } else {
    throw new PDOException("Request parameter is missing!");
  }
}
