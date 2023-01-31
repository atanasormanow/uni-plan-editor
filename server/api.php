<?php
// header("Access-Control-Allow-Origin: *");

// get request method
$method = $_SERVER['REQUEST_METHOD'];
$args = $_SERVER['QUERY_STRING'];
switch ($method) {
  case 'GET':
    // $_GET is a map
    echo "This is a GET request. Args: " . $_GET['hello'];
    break;
  default:
    echo "No such endpoint";
    break;
}
?>
