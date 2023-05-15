<?php
require_once(__DIR__ . '/../model/plan.php');

$p = new Plan(142, 'Kurs po vikane na ura', 'Plyaskame s ryce i vikame ura', 5);
$p->generatePDF();

// TODO: get planId from the url param
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  // TODO: join with owners
  $plan = Queries::getAllPlans();

  if (!$plans) {
    http_response_code(400);
    exit(json_encode(["status" => "ERROR", "message" => "Failed to create plan"]));
  }

  http_response_code(200);
  exit(json_encode(["status" => "SUCCESS", "data" => $plans]));
}
