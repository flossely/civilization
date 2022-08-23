<?php

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
