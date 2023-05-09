<?php
require_once(__DIR__ . '/database/connection.php');
require_once(__DIR__ . '/database/queries.php' );
// header("Access-Control-Allow-Origin: *");

switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    echo handleGetRequest();
    break;
  case 'POST':
    echo handlePostRequest();
    break;
  case 'PUT':
    echo handlePutRequest();
    break;
  case 'DELETE':
    echo handleDeleteRequest();
    break;
  default:
    echo http_response_code(405);
    echo "No such method";
    break;
}

function handleGetRequest()
{
  return Queries::getAllPlans();
}

function handlePostRequest()
{
  $data = json_decode(file_get_contents("php://input"), true);
  error_log(implode($data));
  if (isset($data['name'])) {
    return Queries::createDatabase($data['name']);
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
  // $data = json_decode(file_get_contents("php://input"), true);
  // if (isset($data['name'])) {
  //   return Queries::deleteDatabase($data['name']);
  // } else {
  //   throw new PDOException("Request parameter is missing!");
  // }
}
