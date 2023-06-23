<?php
require_once(__DIR__ . '/../database/queries.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $deps = Queries::getPlanDependencies();
  $plans = Queries::getPartialPlans();

  if (!$plans) {
    http_response_code(400);
    exit(json_encode(["status" => "ERROR", "message" => "Failed to build dependency graph"]));
  }

  $metadata = "rankdir=LR;\n";
  $labels = labelsFromPartialPlans($plans);
  $edges = depEdges($deps);
  $dot_output = "digraph {\n" . $metadata . $labels . $edges . "}";

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
    $majors_label = majors_readable($row['target_majors']);
    $labels .= "{$id} [label=\"{$name} {$majors_label}\", shape=\"note\", margin=0.4]\n";
  }

  return $labels;
}

function majors_readable($majors)
{
  if ($majors === "") {
    return "";
  }

  $replace_map = array(
    'i'  => 'И',
    'is' => 'ИС',
    'kn' => 'КН',
    'si' => 'СИ',
    'ad' => 'АД',
    'm' =>  'М',
    'pm' => 'ПМ',
    's' =>  'С',
    'mi' => 'МИ',
  );

  $majors_list = explode(",", $majors);

  foreach ($majors_list as &$m) {
    $m = $replace_map[$m];
  }

  return "(" . implode(",", $majors_list) . ")";
}

function cleanStr($string)
{
  return preg_replace('/[^\w\s\-\x{0410}-\x{042F}\x{0430}-\x{044F}]/u', '', $string);
}
