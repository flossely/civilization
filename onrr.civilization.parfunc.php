<?php

$subActions = ["pass", "produce"];
$subActionCount = count($subActions);
$subAction = $subActions[rand(0, $subActionCount - 1)];

if ($subAction == "pass") {
    $subRating += 1;
    $subMoney += 1;
    $subScore += 1;
    echo $turnNum." : ".$subFullName.' '.$spacedictus[$proLingo]["pass"]."<br>";
} elseif ($subAction == "produce") {
    $subRating += 1;
    $subMoney += 1;
    $subScore += 1;
    $hashNum = rand(0, 1114111);
    $hashName = dechex($hashNum);
    $calcPrice = rand(1, 10);
    produce($thisParadigm, $yearToday, $sub, $hashName, 'work', $calcPrice);
}
