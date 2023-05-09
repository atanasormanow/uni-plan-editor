<?php
require_once("../database/queries.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $input_data = file_get_contents("php://input");
  $user_data = json_decode($input_data, true);

  $username = $user_data['username'];
  $password = $user_data['password'];

  if (!Queries::verifyUser($username, $password)) {
    http_response_code(401);
    exit(json_encode(["status" => "ERROR", "message" => "Wrong username or password"]));
  }

  $user_db = Queries::getUserByUsername($username); // validation
  $user_db_password = $user_db->getPassword(); // TODO

  if (!password_verify($password, $user_db_password)) {
    http_response_code(401);
    exit(json_encode(["status" => "ERROR", "message" => "Грешен имейл или парола!"]));
  }

  session_start();
  $_SESSION["user"] = $user_db;

  http_response_code(200);
  exit(json_encode(["status" => "SUCCESS", "message" => "Successfully logged in!", "user_id" => $user_db->getUserId()]));
}
