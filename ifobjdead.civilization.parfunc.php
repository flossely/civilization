<?php

$subActions = ["pass", "explore", "willnotstand", "memorial"];
$subActionCount = count($subActions);
$subAction = $subActions[rand(0, $subActionCount - 1)];
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
} elseif ($subAction == "willnotstand") {
    $subRating += 0.02;
    $subScore += 2;
    echo $turnNum." : ".$objFullName.' '.$spacedictus[$proLingo]["willnotstand"]."<br>";
} elseif ($subAction == "memorial") {
    $subRating += 0.05;
    $subScore += 5;
    if (relate($subMode, $objMode) == 'adversary') {
        echo $turnNum." : ".$subFullName.' '.$spacedictus[$proLingo]["to"].' '.$objFullName.' - '.$spacedictus[$proLingo]["goodriddance"]."<br>";
    } elseif (relate($subMode, $objMode) == 'competitor') {
        echo $turnNum." : ".$subFullName.' '.$spacedictus[$proLingo]["to"].' '.$objFullName.' - '.$spacedictus[$proLingo]["burninhell"]."<br>";
    } else {
        echo $turnNum." : ".$subFullName.' '.$spacedictus[$proLingo]["to"].' '.$objFullName.' - '.$spacedictus[$proLingo]["restinpeace"]."<br>";
    }
}
