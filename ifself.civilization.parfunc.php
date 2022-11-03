<?php

$subActions = ["pass", "produce", "vendor", "withdraw"];
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
} elseif ($subAction == "vendor") {
    $msgBox = initExchange($thisParadigm, $yearToday, '.', $sub, $proUseWork, $zoneArr);
    $proMoney = $msgBox['debit'];
    $subMoney = $msgBox['credit'];
} elseif ($subAction == "withdraw") {
    $msgBox = initExchange($thisParadigm, $yearToday, $sub, '.', $subUseWork, $zoneArr);
    $subMoney = $msgBox['debit'];
    $proMoney = $msgBox['credit'];
}
