<?php

$subActions =
[
    'pass', 'explore', 'mine', 'treasure', 'buy', 'sell'
];
$subActionCount = count($subActions);
$subAction = $subActions[rand(0, $subActionCount - 1)];

if (file_exists($sub.'/gold')) {
    $subGold = file_get_contents($sub.'/gold');
} else {
    $subGold = 0;
}
if (file_exists($sub.'/uranium')) {
    $subUraniun = file_get_contents($sub.'/uranium');
    $subActions[] = "make_nuke";
    $subActions[] = "make_thermonuke";
} else {
    $subUranium = 0;
}
if (file_exists($sub.'/nukes')) {
    $subNukes = file_get_contents($sub.'/nukes');
    $subActions[] = "nuke";
} else {
    $subNukes = 0;
}
if (file_exists($sub.'/thermonukes')) {
    $subThermoNukes = file_get_contents($sub.'/thermonukes');
    $subActions[] = "thermonuke";
} else {
    $subThermoNukes = 0;
}

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
} elseif ($subAction == "mine") {
    $subRes = ['gold', 'uranium'];
    $subResCount = count($subRes);
    $subMine = $subRes[rand(0, $subResCount - 1)];
    if ($subMine == 'gold') {
        $subGold += 1;
        echo $turnNum." : ".$subFullName." ".$spacedictus[$proLingo]["mine"]." 1 ".$spacedictus[$proLingo]["gold"]."<br>";
        file_put_contents($sub.'/gold', $subGold);
        chmod($sub.'/gold', 0777);
    } elseif ($subMine == 'uranium') {
        $subUranium += 1;
        echo $turnNum." : ".$subFullName." ".$spacedictus[$proLingo]["mine"]." 1 ".$spacedictus[$proLingo]["uranium"]."<br>";
        file_put_contents($sub.'/uranium', $subUranium);
        chmod($sub.'/uranium', 0777);
    }
} elseif ($subAction == "treasure") {
    if ($subGold > 0) {
        $subMoney += $subMoney + $subScore * $subGold;
        echo $turnNum." : ".$subFullName.' '.$spacedictus[$proLingo]["treasure"]."<br>";
    } else {
        $subRating += 0.01;
        $subScore += 1;
        echo $turnNum." : ".$subFullName.' '.$spacedictus[$proLingo]["pass"]."<br>";
    }
} elseif ($subAction == 'buy') {
    $msgBox = initExchange($thisParadigm, $yearToday, $obj, $sub, $objMoney, $subMoney, ratioCalc($objEconVal, $subEconVal), $objUseItem);
    $objMoney = $msgBox['debit'];
    $subMoney = $msgBox['credit'];
} elseif ($subAction == 'sell') {
    $msgBox = initExchange($thisParadigm, $yearToday, $sub, $obj, $subMoney, $objMoney, ratioCalc($subEconVal, $objEconVal), $subUseItem);
    $subMoney = $msgBox['debit'];
    $objMoney = $msgBox['credit'];
} elseif ($subAction == 'make_nuke') {
    if ($subUranium > 0) {
        $subNukes += 1;
        $subScore += 10;
        echo $turnNum." : ".$subFullName.' '.$spacedictus[$proLingo]["produce"].' '.$spacedictus[$proLingo]["nuke"]."<br>";
        file_put_contents($sub.'/nukes', $subNukes);
        chmod($sub.'/nukes', 0777);
    } else {
        $subRating += 0.01;
        $subScore += 1;
        echo $turnNum." : ".$subFullName.' '.$spacedictus[$proLingo]["pass"]."<br>";
    }
} elseif ($subAction == 'make_thermonuke') {
    if ($subUranium > 0) {
        $subThermoNukes += 1;
        $subScore += 20;
        echo $turnNum." : ".$subFullName.' '.$spacedictus[$proLingo]["produce"].' '.$spacedictus[$proLingo]["nuke"]."<br>";
        file_put_contents($sub.'/thermonukes', $subThermoNukes);
        chmod($sub.'/thermonukes', 0777);
    } else {
        $subRating += 0.01;
        $subScore += 1;
        echo $turnNum." : ".$subFullName.' '.$spacedictus[$proLingo]["pass"]."<br>";
    }
} elseif ($subAction == "nuke") {
    if ($subNukes > 0) {
        $objRating -= $subForce * 50;
        $subRating += $subForce * 5;
        $subNukes -= 1;
        $subScore += 50;
        echo $turnNum." : ".$subFullName.' '.$spacedictus[$proLingo]["nuke"].' '.$objFullName."<br>";
        file_put_contents($sub.'/nukes', $subNukes);
        chmod($sub.'/nukes', 0777);
    } else {
        $subRating += 0.01;
        $subScore += 1;
        echo $turnNum." : ".$subFullName.' '.$spacedictus[$proLingo]["pass"]."<br>";
    }
} elseif ($subAction == "thermonuke") {
    if ($subThermoNukes > 0) {
        $objRating -= $subForce * 100;
        $subRating += $subForce * 10;
        $subThermoNukes -= 1;
        $subScore += 100;
        echo $turnNum." : ".$subFullName.' '.$spacedictus[$proLingo]["nuke"].' '.$objFullName."<br>";
        file_put_contents($sub.'/thermonukes', $subThermoNukes);
        chmod($sub.'/thermonukes', 0777);
    } else {
        $subRating += 0.01;
        $subScore += 1;
        echo $turnNum." : ".$subFullName.' '.$spacedictus[$proLingo]["pass"]."<br>";
    }
}
