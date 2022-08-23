<?php

$subActions = ["envoy", "pass", "explore"];
$subActionCount = count($subActions);
$subAction = $subActions[rand(0, $subActionCount - 1)];

if ($subAction == "envoy") {
    file_put_contents($obj.'/'.$sub.'.envoy.obj', 'suzerain|[>]|'.$subNotation.'|[1]|vassal|[>]|'.$objNotation.'|[1]|relations|[>]|Envoy');
    chmod($obj.'/'.$sub.'.envoy.obj', 0777);
    $subRating += 0.05;
    $subScore += 10;
    echo $turnNum." : ".$subHalfNotation.' '.$spacedictus[$proLingo]["envoy"].' '.$objHalfNotation."<br>";
if ($subAction == "pass") {
    $subRating += 0.01;
    $subScore += 1;
    echo $turnNum." : ".$subHalfNotation.' '.$spacedictus[$proLingo]["pass"]."<br>";
} elseif ($subAction == "explore") {
    $msgBox = movement($turnNum, $subHalfNotation, $subX, $subY, $subZ, 3, $subMove);
    $subX = $msgBox['x'];
    $subY = $msgBox['y'];
    $subZ = $msgBox['z'];
    $subRating += 0.01;
    $subScore += 1;
}
