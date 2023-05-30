<?php
require_once("../database/queries.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $plans = Queries::getPartialPlans();
  $plans = json_encode($plans);

  if (!$plans) {
    http_response_code(400);
    exit(json_encode(["status" => "ERROR", "message" => "Failed to get plans"]));
  }

  http_response_code(200);
  exit(json_encode(["status" => "SUCCESS", "data" => $plans]));
}
