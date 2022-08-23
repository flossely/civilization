<?php

$proUseItem = shopFor('.', 'item');
$subUseItem = shopFor($sub, 'item');
$objUseItem = shopFor($obj, 'item');

$proUseWeapon = shopFor('.', 'weapon');
$subUseWeapon = shopFor($sub, 'weapon');
$objUseWeapon = shopFor($obj, 'weapon');

$proUseMelee = shopFor('.', 'melee');
$subUseMelee = shopFor($sub, 'melee');
$objUseMelee = shopFor($obj, 'melee');

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

if ($proUseMelee !== null) {
    $proMeleeType = $proUseMelee['name'];
    $proMeleeForce = $proUseMelee['damage'];
} else {
    $proMeleeType = 'melee';
    $proMeleeForce = 1;
}
if ($subUseMelee !== null) {
    $subMeleeType = $subUseMelee['name'];
    $subMeleeForce = $subUseMelee['damage'];
} else {
    $subMeleeType = 'melee';
    $subMeleeForce = 1;
}
if ($objUseMelee !== null) {
    $objMeleeType = $objUseMelee['name'];
    $objMeleeForce = $objUseMelee['damage'];
} else {
    $objMeleeType = 'melee';
    $objMeleeForce = 1;
}
