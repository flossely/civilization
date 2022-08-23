<?php

$subActions = ['pass', 'explore', 'actions'];
$subActionCount = count($subActions);
$subAction = $subActions[rand(0, $subActionCount - 1)];

if (file_exists($sub.'/nukes')) {
    $nukesFile = file_get_contents($sub.'/nukes');
    if (valuable($nukesFile)) {
        $subActions[] = "nuke";
    }
}
if (file_exists($sub.'/thermonukes')) {
    $thermonukesFile = file_get_contents($sub.'/thermonukes');
    if (valuable($thermonukesFile)) {
        $subActions[] = "thermonuke";
    }
}

if ($subAction == "pass") {
    $subRating += 0.01;
    $subScore += 1;
    echo $turnNum." : ".$subHalfNotation.' '.$spacedictus[$proLingo]["pass"]."<br>";
} elseif ($subAction == "explore") {
    $msgBox = movement($turnNum, $subHalfNotation, $subX, $subY, $subZ, 3, $subMove);
    $subX = $msgBox['x'];
    $subY = $msgBox['y'];
    $subZ = $msgBox['z'];
    $subRating += 0.01;
    $subScore += 1;
} elseif ($subAction == "nuke") {
    $objRating -= $subForce * 50;
    $subRating += $subForce * 50;
    $subScore += 50;
    echo $turnNum." : ".$subHalfNotation.' '.$spacedictus[$proLingo]["nuke"].' '.$objHalfNotation."<br>";
} elseif ($subAction == "thermonuke") {
    $objRating -= $subForce * 100;
    $subRating += $subForce * 100;
    $subScore += 100;
    echo $turnNum." : ".$subHalfNotation.' '.$spacedictus[$proLingo]["nuke"].' '.$objHalfNotation."<br>";
} elseif ($subAction == "actions") {
    if ($subRearmed) {
        if ($subVehicleType == 'land') {
            $subWhoActions = ["drive", "shoot"];
            $subWhoActionCount = count($subWhoActions);
            $subWhoAction = $subWhoActions[rand(0, $subWhoActionCount - 1)];
            if (!classEmpty($sub, 'vehicle')) {
                $subWhoActions[] = 'exit';
            }
            if ($subOper == 'drive') {
                $msgBox = movement($turnNum, $subHalfNotation, $subX, $subY, $subZ, 3, $subVehicleSpeed);
                $subX = $msgBox['x'];
                $subY = $msgBox['y'];
                $subZ = $msgBox['z'];
            } elseif ($subOper == 'shoot') {
                $objRating -= $subVehicleDamage + $objShield;
                $subRating += $subVehicleDamage - $objShield;
                $subScore += 10;
                echo $turnNum." : ".$subHalfNotation.' '.$subVehicleName." (".$subVehicleDamage."/".$objShield.") ".$objHalfNotation."<br>";
            } elseif ($subOper == 'exit') {
                $subRearmed = false;
            }
        } elseif ($subVehicleType == 'naval') {
            $subWhoActions = ["seal", "shoot"];
            $subWhoActionCount = count($subWhoActions);
            $subWhoAction = $subWhoActions[rand(0, $subWhoActionCount - 1)];
            if (!classEmpty($sub, 'vehicle')) {
                $subWhoActions[] = 'exit';
            }
            if ($subOper == 'seal') {
                $msgBox = movement($turnNum, $subHalfNotation, $subX, $subY, $subZ, 3, $subVehicleSpeed);
                $subX = $msgBox['x'];
                $subY = $msgBox['y'];
                $subZ = $msgBox['z'];
            } elseif ($subOper == 'shoot') {
                $objRating -= $subVehicleDamage + $objShield;
                $subRating += $subVehicleDamage - $objShield;
                $subScore += 10;
                echo $turnNum." : ".$subHalfNotation.' '.$subVehicleName." (".$subVehicleDamage."/".$objShield.") ".$objHalfNotation."<br>";
            } elseif ($subOper == 'exit') {
                $subRearmed = false;
            }
        } elseif ($subVehicleType == 'aircraft') {
            $subWhoActions = ["flight", "shoot"];
            $subWhoActionCount = count($subWhoActions);
            $subWhoAction = $subWhoActions[rand(0, $subWhoActionCount - 1)];
            if (!classEmpty($sub, 'vehicle')) {
                $subWhoActions[] = 'exit';
            }
            if ($subOper == 'flight') {
                $msgBox = movement($turnNum, $subHalfNotation, $subX, $subY, $subZ, 5, $subVehicleSpeed);
                $subX = $msgBox['x'];
                $subY = $msgBox['y'];
                $subZ = $msgBox['z'];
            } elseif ($subOper == 'shoot') {
                $objRating -= $subVehicleDamage + $objShield;
                $subRating += $subVehicleDamage - $objShield;
                $subScore += 10;
                echo $turnNum." : ".$subHalfNotation.' '.$subVehicleName." (".$subVehicleDamage."/".$objShield.") ".$objHalfNotation."<br>";
            } elseif ($subOper == 'exit') {
                $subRearmed = false;
            }
        }
    } else {
        $subWhoActions = ["agent", "soldier", "knight", "trade"];
        $subWhoActionCount = count($subWhoActions);
        $subWhoAction = $subWhoActions[rand(0, $subWhoActionCount - 1)];
        if (!classEmpty($sub, 'vehicle')) {
            $subWhoActions[] = 'enter';
        }
        if ($subWhoAction == "agent") {
            $subOpsList = ['navigate', 'melee'];
            $subOpsCount = count($subOpsList);
            $subOper = $subOpsList[rand(0, $subOpsCount - 1)];
            if ($subOper == 'navigate') {
                $msgBox = movement($turnNum, $subHalfNotation, $subX, $subY, $subZ, 3, $subMove);
                $subX = $msgBox['x'];
                $subY = $msgBox['y'];
                $subZ = $msgBox['z'];
            } elseif ($subOper == 'melee') {
                $objRating -= $subMeleeForce;
                $subRating += $subMeleeForce;
                $subScore += 20;
                echo $turnNum." : ".$subHalfNotation.' '.$subForceType." (".$subMeleeForce."/".$objShield.") ".$objHalfNotation."<br>";
            }
        } elseif ($subWhoAction == "knight") {
            $subOpsList = ['navigate', 'melee'];
            $subOpsCount = count($subOpsList);
            $subOper = $subOpsList[rand(0, $subOpsCount - 1)];
            if ($subOper == 'navigate') {
                $msgBox = movement($turnNum, $subHalfNotation, $subX, $subY, $subZ, 3, $subMove);
                $subX = $msgBox['x'];
                $subY = $msgBox['y'];
                $subZ = $msgBox['z'];
            } elseif ($subOper == 'melee') {
                $objRating -= $subMeleeForce;
                $subRating += $subMeleeForce;
                $subScore += 20;
                echo $turnNum." : ".$subHalfNotation.' '.$subForceType." (".$subMeleeForce."/".$objShield.") ".$objHalfNotation."<br>";
            }
        } elseif ($subWhoAction == "soldier") {
            $subOpsList = ['navigate', 'assault'];
            $subOpsCount = count($subOpsList);
            $subOper = $subOpsList[rand(0, $subOpsCount - 1)];
            if ($subOper == 'navigate') {
                $msgBox = movement($turnNum, $subHalfNotation, $subX, $subY, $subZ, 3, $subMove);
                $subX = $msgBox['x'];
                $subY = $msgBox['y'];
                $subZ = $msgBox['z'];
            } elseif ($subOper == 'assault') {
                $objRating -= $subForce + $objShield;
                $subRating += $subForce - $objShield;
                $subScore += 10;
                echo $turnNum." : ".$subHalfNotation.' '.$subForceType." (".$subForce."/".$objShield.") ".$objHalfNotation."<br>";
            }
        } elseif ($subWhoAction == "enter") {
            $subRearmed = true;
        } elseif ($subWhoAction == "trade") {
            $subWantsTrade = ['item', 'weapon', 'melee', 'vehicle'];
            $subWantsCount = count($subWantsTrade);
            $subWantAction = $subWantsTrade[rand(0, $subWantsCount - 1)];
    
            if ($subWantAction == 'item') {
                $subTradeMode = rand(0, 1);
                if ($subTradeMode == 0) {
                    $msgBox = initExchange($thisParadigm, $yearToday, $obj, $sub, $objMoney, $subMoney, ratioCalc($objEconVal, $subEconVal), $objUseItem);
                    $objMoney = $msgBox['debit'];
                    $subMoney = $msgBox['credit'];
                } elseif ($subTradeMode == 1) {
                    $msgBox = initExchange($thisParadigm, $yearToday, $sub, $obj, $subMoney, $objMoney, ratioCalc($subEconVal, $objEconVal), $subUseItem);
                    $subMoney = $msgBox['debit'];
                    $objMoney = $msgBox['credit'];
                }
            } elseif ($subWantAction == 'weapon') {
                $subTradeMode = rand(0, 1);
                if ($subTradeMode == 0) {
                    $msgBox = initExchange($thisParadigm, $yearToday, $obj, $sub, $objMoney, $subMoney, ratioCalc($objEconVal, $subEconVal), $objUseWeapon);
                    $objMoney = $msgBox['debit'];
                    $subMoney = $msgBox['credit'];
                } elseif ($subTradeMode == 1) {
                    $msgBox = initExchange($thisParadigm, $yearToday, $sub, $obj, $subMoney, $objMoney, ratioCalc($subEconVal, $objEconVal), $subUseWeapon);
                    $subMoney = $msgBox['debit'];
                    $objMoney = $msgBox['credit'];
                }
            } elseif ($subWantAction == 'melee') {
                $subTradeMode = rand(0, 1);
                if ($subTradeMode == 0) {
                    $msgBox = initExchange($thisParadigm, $yearToday, $obj, $sub, $objMoney, $subMoney, ratioCalc($objEconVal, $subEconVal), $objUseMelee);
                    $objMoney = $msgBox['debit'];
                    $subMoney = $msgBox['credit'];
                } elseif ($subTradeMode == 1) {
                    $msgBox = initExchange($thisParadigm, $yearToday, $sub, $obj, $subMoney, $objMoney, ratioCalc($subEconVal, $objEconVal), $subUseMelee);
                    $subMoney = $msgBox['debit'];
                    $objMoney = $msgBox['credit'];
                }
            } elseif ($subWantAction == 'vehicle') {
                $subTradeMode = rand(0, 1);
                if ($subTradeMode == 0) {
                    $msgBox = initExchange($thisParadigm, $yearToday, $obj, $sub, $objMoney, $subMoney, ratioCalc($objEconVal, $subEconVal), $objUseVehicle);
                    $objMoney = $msgBox['debit'];
                    $subMoney = $msgBox['credit'];
                } elseif ($subTradeMode == 1) {
                    $msgBox = initExchange($thisParadigm, $yearToday, $sub, $obj, $subMoney, $objMoney, ratioCalc($subEconVal, $objEconVal), $subUseVehicle);
                    $subMoney = $msgBox['debit'];
                    $objMoney = $msgBox['credit'];
                }
            }
        }
    }
}
