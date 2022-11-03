<?php

$subActions = ["pass", "mine"];
$subActionCount = count($subActions);
$subAction = $subActions[rand(0, $subActionCount - 1)];

if ($subAction == "pass") {
    $subRating += 1;
    $subMoney += 1;
    $subScore += 1;
    echo $turnNum." : ".$subFullName.' '.$spacedictus[$proLingo]["pass"]."<br>";
} elseif ($subAction == "mine") {
    $subRating += 1;
    $subScore += 1;
    $actBox = initMine($sub);
    $subMoney = $actBox['money'];
    $subDispCurSign = $actBox['sign'];
    echo $turnNum." : ".$subFullName.' '.$spacedictus[$proLingo]["mine"].' '.$subDispCurSign.$subMoney."<br>";
}
