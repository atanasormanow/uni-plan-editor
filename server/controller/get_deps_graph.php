<?php
require_once(__DIR__ . '/../database/queries.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $deps = Queries::getPlanDependencies();
  $plans = Queries::getPartialPlans();

  if (!$plans) {
    http_response_code(400);
    exit(json_encode(["status" => "ERROR", "message" => "Failed to build dependency graph"]));
  }

  $labels = labelsFromPartialPlans($plans);
  $edges = depEdges($deps);
  $dot_output = "digraph {\n" . $labels . $edges . "}";

  // TODO: use local graphviz library
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
    $labels .= "{$id} [label=\"{$name}\", shape=\"box\"]\n";
  }

  return $labels;
}

function cleanStr($string)
{
  return preg_replace('/[^\w\s\-\x{0410}-\x{042F}\x{0430}-\x{044F}]/u', '', $string);
}
