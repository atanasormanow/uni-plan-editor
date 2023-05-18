<?php
require_once(__DIR__ . '/../database/queries.php');
require_once(__DIR__ . '/../model/plan.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $plan_id = $_GET['id'];
  $plan = Queries::getPlanById($plan_id);

  if (!$plan) {
    http_response_code(404);
    exit(json_encode(["status" => "ERROR", "message" => "Not found"]));
  }

  http_response_code(200);
  exit(json_encode(["status" => "SUCCESS", "data" => $plan->expose()]));
}
