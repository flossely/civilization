<?php

$subActions = ['assault'];
$subActionCount = count($subActions);
$subAction = $subActions[rand(0, $subActionCount - 1)];

if ($subUseBomb !== null) {
    $subActions[] = 'bombard';
}

if ($subAction == "assault") {
    if ($objUseShield !== null) {
        $objRating -= $subForce + $objShield;
        $subRating += $subForce - $objShield;
        $subScore += $subForce - $objShield;
    } else {
        $objRating -= $subForce;
        $subRating += $subForce;
        $subScore += $subForce;
    }
    echo $turnNum." : ".$subFullName.' '.$subForceType." (".$subForce."/".$objShield.") ".$objFullName."<br>";
} elseif ($subAction == "bombard") {
    if ($objUseShield !== null) {
        $objRating -= $subBombForce + $objShield;
        $subRating += $subBombForce - $objShield;
        $subScore += $subBombForce - $objShield;
    } else {
        $objRating -= $subBombForce;
        $subRating += $subBombForce;
        $subScore += $subBombForce;
    }
    echo $turnNum." : ".$subFullName.' '.$subBombType." (".$subBombForce."/".$objShield.") ".$objFullName."<br>";
}
