<?php

$proUseWeapon = shopFor('.', 'weapon');
$subUseWeapon = shopFor('./'.$sub, 'weapon');
$objUseWeapon = shopFor('./'.$obj, 'weapon');

if ($proUseWeapon !== null) {
    $proWeaponName = $proUseWeapon['name'];
    $proWeaponPrice = $proUseWeapon['price'] * ratioCalc($spacedictus[$subLingo]['curval'], $spacedictus[$objLingo]['curval']);
    $proForce = $proUseWeapon['damage'];
} else {
    $proWeaponName = $spacedictus[$lingua]['melee'];
    $proWeaponPrice = 0;
    $proForce = 1;
}

if ($subUseWeapon !== null) {
    $subWeaponName = $subUseWeapon['name'];
    $subWeaponPrice = $subUseWeapon['price'] * ratioCalc($spacedictus[$subLingo]['curval'], $spacedictus[$objLingo]['curval']);
    $subForce = $subUseWeapon['damage'];
} else {
    $subWeaponName = $spacedictus[$lingua]['melee'];
    $subWeaponPrice = 0;
    $subForce = 1;
}

if ($objUseWeapon !== null) {
    $objWeaponName = $objUseWeapon['name'];
    $objWeaponPrice = $objUseWeapon['price'] * ratioCalc($spacedictus[$subLingo]['curval'], $spacedictus[$objLingo]['curval']);
    $objForce = $objUseWeapon['damage'];
} else {
    $objWeaponName = $spacedictus[$lingua]['melee'];
    $objWeaponPrice = 0;
    $objForce = 1;
}
