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

  file_put_contents("../graph/graph.dot", $dot_output);
  $svgContent = shell_exec("dot -Tsvg ../graph/graph.dot");

  header('Content-type: image/svg+xml');
  echo $svgContent;
}

function depEdges($deps)
{
  $edges = "";
  foreach ($deps as $row) {
    $edges .= "{$row['plan_id_dependency']} -> {$row['plan_id_main']}\n";
  }

  return $edges;
}

function labelsFromPartialPlans($plans)
{
  $labels = "";
  foreach ($plans as $row) {
    $id = $row['id'];
    $name = cleanStr($row['name']);
    $labels .= "{$id} [label=\"{$name}\"]\n";
  }

  return $labels;
}

function cleanStr($string) {
   return preg_replace('/[^A-Za-z0-9\-\s]/', '', $string);
}
