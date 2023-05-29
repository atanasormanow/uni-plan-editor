<?php
require_once(__DIR__ . '/../database/queries.php');

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
  $plan_id = $_GET['id'];
  $success = Queries::deletePlanById($plan_id);

  if (!$success) {
    http_response_code(200);
    exit(json_encode(["status" => "SUCCESS", "message" => "Plan deleted successfully"]));
  } else {
    http_response_code(400);
    exit(json_encode(["status" => "ERROR", "message" => "Failed to delete plan"]));
  }
}
