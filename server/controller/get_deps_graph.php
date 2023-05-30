<?php
require_once(__DIR__ . '/../database/queries.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $deps = Queries::getPlanDependencies();
  $plans = Queries::getPartialPlans();

  if (!$deps or !$plans) {
    http_response_code(400);
    exit(json_encode(["status" => "ERROR", "message" => "Failed to get dependencies"]));
  }

  $labels = labelsFromPartialPlans($plans);
  $edges = depEdges($deps);
  $dot_output = "digraph {\n" . $labels . $edges . "}";

  $svgContent = file_get_contents("../graph/output.svg");
  header('Content-type: image/svg+xml');

  echo $svgContent;
}

function depEdges($deps)
{
  $edges = "";
  foreach ($deps as $row) {
    $edges .= "{$row['plan_id_main']} -> {$row['plan_id_dependency']}\n";
  }

  return $edges;
}

function labelsFromPartialPlans($plans)
{
  $labels = "";
  foreach ($plans as $row) {
    $labels .= "{$row['id']} [label=\"{$row['name']}\"]\n";
  }

  return $labels;
}
