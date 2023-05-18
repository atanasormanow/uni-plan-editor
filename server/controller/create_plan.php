<?php
require_once("../database/queries.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $input_data = file_get_contents("php://input");
  $plan_data = json_decode($input_data, true);

  $type = $plan_data['type'];
  $targetMajors = $plan_data['targetMajors'];
  $name = $plan_data['name'];
  $department = $plan_data['department'];
  $busyness = $plan_data['busyness'];
  $credits = $plan_data['credits'];
  $description = $plan_data['description'];
  $requiredSkills = $plan_data['requiredSkills'];
  $dependencies = $plan_data['dependencies'];
  $learnedSkills = $plan_data['learnedSkills'];
  $contents = $plan_data['contents'];
  $examSynopsis = $plan_data['examSynopsis'];
  $bibliography = $plan_data['bibliography'];
  $owner = $plan_data['owner'];

  $plan = Queries::createPlan(
    $type,
    $targetMajors,
    $name,
    $department,
    $busyness,
    $credits,
    $description,
    $requiredSkills,
    $dependencies,
    $learnedSkills,
    $contents,
    $examSynopsis,
    $bibliography,
    $owner,
  );

  if (!$plan) {
    http_response_code(400);
    exit(json_encode(["status" => "ERROR", "message" => "Failed to create plan"]));
  }

  http_response_code(200);
  exit(json_encode(["status" => "SUCCESS", "message" => "Successfully logged in", "plan_id" => $plan->getPlanId()]));
}
