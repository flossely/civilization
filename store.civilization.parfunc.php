<?php

$searchProIn = '.';
$searchProFor = $searchProIn;
$objectsProList = str_replace($searchProFor.'/','',(glob($searchProFor.'/*.weapon.obj')));
$objectsProCount = count($objectsProList);
if (!empty($objectsProList)) {
    $randomObjectProNum = rand(0, $objectsProCount - 1);
    $randomObjectPro = $objectsProList[$randomObjectProNum];
    $proUseWeapon = getArrayFromFile('./'.$randomObjectPro);
    $proWeaponName = $proUseWeapon['name'];
    $proWeaponPrice = $proUseWeapon['price'] * ratioCalc($spacedictus[$subLingo]['curval'], $spacedictus[$objLingo]['curval']);
    $proForce = $proUseWeapon['damage'];
} else {
    $proWeaponName = $spacedictus[$lingua]['melee'];
    $proWeaponPrice = 0;
    $proForce = 1;
}

$subMove = power('move', $subRating);
$subReach = power('reach', $subRating);
$subShield = power('shield', $subRating);
$subHeal = power('heal', $subRating);
$searchSubIn = '.';
$searchSubFor = $searchSubIn.'/'.$sub;
$objectsSubList = str_replace($searchSubFor.'/','',(glob($searchSubFor.'/*.weapon.obj')));
$objectsSubCount = count($objectsSubList);
if (!empty($objectsSubList)) {
    $randomObjectSubNum = rand(0, $objectsSubCount - 1);
    $randomObjectSub = $objectsSubList[$randomObjectSubNum];
    $subUseWeapon = getArrayFromFile('./'.$sub.'/'.$randomObjectSub);
    $subWeaponName = $subUseWeapon['name'];
    $subWeaponPrice = $subUseWeapon['price'] * ratioCalc($spacedictus[$subLingo]['curval'], $spacedictus[$objLingo]['curval']);
    $subForce = $subUseWeapon['damage'];
} else {
    $subWeaponName = $spacedictus[$lingua]['melee'];
    $subWeaponPrice = 0;
    $subForce = 1;
}

$objMove = power('move', $objRating);
$objReach = power('reach', $objRating);
$objShield = power('shield', $objRating);
$objHeal = power('heal', $objRating);
$searchObjIn = '.';
$searchObjFor = $searchObjIn.'/'.$obj;
$objectsObjList = str_replace($searchObjFor.'/','',(glob($searchObjFor.'/*.weapon.obj')));
$objectsObjCount = count($objectsObjList);
if (!empty($objectsObjList)) {
    $randomObjectObjNum = rand(0, $objectsObjCount - 1);
    $randomObjectObj = $objectsObjList[$randomObjectObjNum];
    $objUseWeapon = getArrayFromFile('./'.$obj.'/'.$randomObjectObj);
    $objWeaponName = $objUseWeapon['name'];
    $objWeaponPrice = $objUseWeapon['price'] * ratioCalc($spacedictus[$subLingo]['curval'], $spacedictus[$objLingo]['curval']);
    $objForce = $objUseWeapon['damage'];
} else {
    $objWeaponName = $spacedictus[$lingua]['melee'];
    $objWeaponPrice = 0;
    $objForce = 1;
}
