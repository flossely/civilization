<?php

function civProgress($era) {
    if (($era == 'i') && ($era == 'ii')) {
        return 0.0001;
    } elseif (($era == 'iii') && ($era == 'iv')) {
        return 0.001;
    } elseif (($era == 'v') && ($era == 'vi')) {
        return 0.01;
    } elseif (($era == 'vii') && ($era == 'viii')) {
        return 0.1;
    } elseif (($era == 'ix') && ($era == 'x')) {
        return 1;
    }
}

function eraPass($year) {
    if ($year < -1000) {
        $getEra = 'i';
    } elseif (($year >= -1000) && ($year < 476)) {
        $getEra = 'ii';
    } elseif (($year >= 476) && ($year < 1500)) {
        $getEra = 'iii';
    } elseif (($year >= 1500) && ($year < 1700)) {
        $getEra = 'iv';
    } elseif (($year >= 1700) && ($year < 1900)) {
        $getEra = 'v';
    } elseif (($year >= 1900) && ($year < 1950)) {
        $getEra = 'vi';
    } elseif (($year >= 1950) && ($year < 1990)) {
        $getEra = 'vii';
    } elseif (($year >= 1990) && ($year < 2050)) {
        $getEra = 'viii';
    } elseif (($year >= 2050) && ($year < 2100)) {
        $getEra = 'ix';
    } elseif ($year >= 2100) {
        $getEra = 'x';
    }
    return $getEra;
}

if (file_exists($sub.'/era')) {
    $subEraNum = file_get_contents($sub.'/era');
} else {
    $subEraNum = 'i';
}
if (file_exists($obj.'/era')) {
    $objEraNum = file_get_contents($obj.'/era');
} else {
    $objEraNum = 'i';
}

$proUseItem = shopFor('.', 'item');
$subUseItem = shopFor($sub, 'item');
$objUseItem = shopFor($obj, 'item');

$proUseWeapon = shopFor('.', 'weapon');
$subUseWeapon = shopFor($sub, 'weapon');
$objUseWeapon = shopFor($obj, 'weapon');

if ($proUseWeapon !== null) {
    $proForceType = $proUseWeapon['name'];
    $proForce = $proUseWeapon['damage'];
} else {
    $proForceType = 'melee';
    $proForce = 1;
}
if ($subUseWeapon !== null) {
    $subForceType = $subUseWeapon['name'];
    $subForce = $subUseWeapon['damage'];
} else {
    $subForceType = 'melee';
    $subForce = 1;
}
if ($objUseWeapon !== null) {
    $objForceType = $objUseWeapon['name'];
    $objForce = $objUseWeapon['damage'];
} else {
    $objForceType = 'melee';
    $objForce = 1;
}

$proUseBomb = shopFor('.', 'bomb');
$subUseBomb = shopFor($sub, 'bomb');
$objUseBomb = shopFor($obj, 'bomb');

if ($proUseBomb !== null) {
    $proBombType = $proUseBomb['name'];
    $proBombForce = $proUseBomb['damage'];
} else {
    $proBombType = 'bash';
    $proBombForce = 1;
}
if ($subUseBomb !== null) {
    $subBombType = $subUseBomb['name'];
    $subBombForce = $subUseBomb['damage'];
} else {
    $subBombType = 'bash';
    $subBombForce = 1;
}
if ($objUseBomb !== null) {
    $objBombType = $objUseBomb['name'];
    $objBombForce = $objUseBomb['damage'];
} else {
    $objBombType = 'bash';
    $objBombForce = 1;
}
