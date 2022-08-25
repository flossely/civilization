<?php

$subActions = ['assault', 'bombard'];
$subActionCount = count($subActions);
$subAction = $subActions[rand(0, $subActionCount - 1)];

if ($subAction == "assault") {
    if ($objUseShield !== null) {
        $objRating -= $subForce + $objShield;
        $subRating += $subForce - $objShield;
        $subScore += $subForce - $objShield;
        echo $turnNum." : ".$subFullName.' '.$subForceType." (".$subForce."/".$objShield.") ".$objFullName."<br>";
    } else {
        $objRating -= $subForce;
        $subRating += $subForce;
        $subScore += $subForce;
        echo $turnNum." : ".$subFullName.' '.$subForceType." (".$subForce.") ".$objFullName."<br>";
    }
} elseif ($subAction == "bombard") {
    if ($objUseShield !== null) {
        $objRating -= $subBombForce + $objShield;
        $subRating += $subBombForce - $objShield;
        $subScore += $subBombForce - $objShield;
        echo $turnNum." : ".$subFullName.' '.$subBombType." (".$subBombForce."/".$objShield.") ".$objFullName."<br>";
    } else {
        $objRating -= $subBombForce;
        $subRating += $subBombForce;
        $subScore += $subBombForce;
        echo $turnNum." : ".$subFullName.' '.$subBombType." (".$subBombForce.") ".$objFullName."<br>";
    }
}
