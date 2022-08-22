<?php

$proUseWeapon = shopFor('.', 'weapon');
$subUseWeapon = shopFor($sub, 'weapon');
$objUseWeapon = shopFor($obj, 'weapon');

if ($proUseWeapon !== null) {
    $proForce = $proUseWeapon['damage'];
} else {
    $proForce = 1;
}
if ($subUseWeapon !== null) {
    $subForce = $subUseWeapon['damage'];
} else {
    $subForce = 1;
}
if ($objUseWeapon !== null) {
    $objForce = $objUseWeapon['damage'];
} else {
    $objForce = 1;
}
