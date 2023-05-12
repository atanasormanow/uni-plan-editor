<?php
require_once("../database/queries.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $input_data = file_get_contents("php://input");
  $user_data = json_decode($input_data, true);

  $name = $user_data['name'];
  $owner = $user_data['owner'];
  $description = $user_data['description'];

  $plan = Queries::createPlan($name, $owner, $description);
  if (!$plan) {
    http_response_code(400);
    exit(json_encode(["status" => "ERROR", "message" => "Failed to create plan"]));
  }

  http_response_code(200);
  exit(json_encode(["status" => "SUCCESS", "message" => "Successfully logged in", "plan_id" => $plan->getPlanId()]));
}
