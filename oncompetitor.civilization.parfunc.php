<?php

$subActions = ["pass", "agent"];
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
        $spacedictus[$proLingo]["pass"] .
        "<br>";
} elseif ($subAction == "agent") {
    $subOpsList = ['navigate', 'attack'];
    $subOpsCount = count($subOpsList);
    $subOper = $subOpsList[rand(0, $subOpsCount - 1)];
    if ($subOper == 'navigate') {
        echo movement($turnNum, $subNotation, $subX, $subY, $subZ, 3, $subMove);
    } elseif ($subOper == 'attack') {
        $objRating -= $subForce + $objShield;
        $subRating += $subForce - $objShield;
        $subScore += 5;
        echo $turnNum .
            " : " .
            $subModeSign .
            $sub .
            "[" .
            $subRating .
            "] " .
            $subWeaponName .
            " (" .
            $subForce .
            ") " .
            $objModeSign .
            $obj .
            "[" .
            $objRating .
            "]<br>";
    }
}
