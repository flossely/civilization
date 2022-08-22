<?php

$subActions = ["envoy", "pass"];
$subActionCount = count($subActions);
$subAction = $subActions[rand(0, $subActionCount - 1)];
if ($subAction == "envoy") {
    file_put_contents($obj.'/'.$sub.'.envoy.obj', 'suzerain|[>]|'.$sub.'|[1]|vassal|[>]|'.$obj.'|[1]|relations|[>]|Envoy');
    chmod($obj.'/'.$sub.'.envoy.obj', 0777);
    $subRating += 0.05;
    $subScore += 10;
    echo $turnNum .
        " : " .
        $subModeSign .
        $sub .
        "[" .
        $subRating .
        "] " .
        $spacedictus[$proLingo]["envoy"] .
        $objModeSign .
        $obj .
        "[" .
        $objRating .
        "<br>";
} elseif ($subAction == "pass") {
    $subRating += 0.01;
    $subScore += 1;
    echo $turnNum .
        " : " .
        $subModeSign .
        $sub .
        "[" .
        $subRating .
        "] " .
        $spacedictus[$proLingo]["pass"] .
        "<br>";
}
