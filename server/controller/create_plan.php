<?php
require_once("../database/queries.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $input_data = file_get_contents("php://input");
  $data = json_decode($input_data, true);

  $type = $data['type'];
  $targetMajors = $data['targetMajors'];
  $name = $data['name'];
  $department = $data['department'];
  $busyness = $data['busyness'];
  $credits = $data['credits'];
  $description = $data['description'];
  $requiredSkills = $data['requiredSkills'];
  $aquiredSkills = $data['aquiredSkills'];
  $contents = $data['contents'];
  $examSynopsis = $data['examSynopsis'];
  $bibliography = $data['bibliography'];
  $owner = $data['owner'];
  $dependencies = $data['dependencies'];

  $plan = Queries::createPlan(
    $type,
    $targetMajors,
    $name,
    $department,
    $busyness,
    $credits,
    $description,
    $requiredSkills,
    $aquiredSkills,
    $contents,
    $examSynopsis,
    $bibliography,
    $owner,
    $dependencies
  );

  if (!$plan) {
    http_response_code(400);
    exit(json_encode([
      "status" => "ERROR",
      "message" => "Failed to create plan"
    ]));
  }

  http_response_code(200);
  exit(json_encode([
    "status" => "SUCCESS",
    "message" => "Successfully created a plan",
    "plan_id" => $plan->getPlanId()
  ]));
}
