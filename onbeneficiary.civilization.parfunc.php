<?php

$subActions = ["envoy", "pass", "explore"];
$subActionCount = count($subActions);
$subAction = $subActions[rand(0, $subActionCount - 1)];

if ($subAction == "envoy") {
    file_put_contents($obj.'/'.$sub.'.envoy.obj', 'suzerain|[>]|'.$subFullName.'|[1]|vassal|[>]|'.$objFullName.'|[1]|relations|[>]|Envoy');
    chmod($obj.'/'.$sub.'.envoy.obj', 0777);
    $subRating += 0.05;
    $subScore += 10;
    echo $turnNum." : ".$subFullName.' '.$spacedictus[$proLingo]["envoy"].' '.$objFullName."<br>";
if ($subAction == "pass") {
    $subRating += 0.01;
    $subScore += 1;
    echo $turnNum." : ".$subFullName.' '.$spacedictus[$proLingo]["pass"]."<br>";
} elseif ($subAction == "explore") {
    $msgBox = movement($turnNum, $subFullName, $subX, $subY, $subZ, 3, $subMove);
    $subX = $msgBox['x'];
    $subY = $msgBox['y'];
    $subZ = $msgBox['z'];
    $subRating += 0.01;
    $subScore += 1;
}
