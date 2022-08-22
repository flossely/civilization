<?php

$subActions = ["envoy", "pass"];
$subActionCount = count($subActions);
$subAction = $subActions[rand(0, $subActionCount - 1)];
if ($subAction == "envoy") {
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
