<?php

$subActions = ["pass"];
$subActionCount = count($subActions);
$subAction = $subActions[rand(0, $subActionCount - 1)];
if ($subAction == "pass") {
    $subRating += 0.01;
    $subScore += 1;
    echo $turnNum .
        " : " .
        $subModeSign .
        $sub .
        "[" .
        $subRating .
        "] " .
        $spacedictus[$subLingo]["pass"] .
        "<br>";
}
