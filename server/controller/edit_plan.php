<?php
require_once("../database/queries.php");

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
  $input_data = file_get_contents("php://input");
  $data = json_decode($input_data, true);
  $planId = $_GET['id'];

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

  $plan = Queries::editPlan(
    $planId,
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
    exit(json_encode(["status" => "ERROR", "message" => "Failed to edit plan"]));
  }

  http_response_code(200);
  exit(json_encode(["status" => "SUCCESS", "message" => "Successfully edited plan", "plan_id" => $plan->getPlanId()]));
}
