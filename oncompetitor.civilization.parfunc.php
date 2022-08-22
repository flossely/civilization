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
    $subOpsList = rand('navigate', 'attack');
    $subOpsCount = count($subOpsList);
    $subOper = $subOpsList[rand(0, $subOpsCount - 1)];
    if ($subOper == 'navigate') {
        $subDirect = rand(0, 3);
        if ($subDirect == 0) {
            $subX += $subMove;
            $subScore += 0.1;
            echo $turnNum .
                " : " .
                $subModeSign .
                $sub .
                "[" .
                $subRating .
                "] " .
                $spacedictus[$proLingo]["right"] .
                " {" .
                $subX .
                ";" .
                $subY .
                ";" .
                $subZ .
                "}<br>";
        } elseif ($subDirect == 1) {
            $subX -= $subMove;
            $subScore += 0.1;
            echo $turnNum .
                " : " .
                $subModeSign .
                $sub .
                "[" .
                $subRating .
                "] " .
                $spacedictus[$proLingo]["left"] .
                " {" .
                $subX .
                ";" .
                $subY .
                ";" .
                $subZ .
                "}<br>";
        } elseif ($subDirect == 2) {
            $subY += $subMove;
            $subScore += 0.1;
            echo $turnNum .
                " : " .
                $subModeSign .
                $sub .
                "[" .
                $subRating .
                "] " .
                $spacedictus[$proLingo]["forward"] .
                " {" .
                $subX .
                ";" .
                $subY .
                ";" .
                $subZ .
                "}<br>";
        } elseif ($subDirect == 3) {
            $subY -= $subMove;
            $subScore += 0.1;
            echo $turnNum .
                " : " .
                $subModeSign .
                $sub .
                "[" .
                $subRating .
                "] " .
                $spacedictus[$proLingo]["back"] .
                " {" .
                $subX .
                ";" .
                $subY .
                ";" .
                $subZ .
                "}<br>";
        }
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
