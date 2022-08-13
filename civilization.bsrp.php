<?php

if (file_exists('paradigm')) {
    $paradigm = file_get_contents('paradigm');
} else {
    $paradigm = 'default';
}
$paradigmFile = file_get_contents($paradigm.'.par');
$paradigmArr = explode('|[1]|', $paradigmFile);
$paradigmData = [];
foreach ($paradigmArr as $key=>$value) {
    $paradigmExp = explode('|[>]|', $value);
    $paradigmElemProp = $paradigmExp[0];
    $paradigmElemVal = $paradigmExp[1];
    $paradigmData[$paradigmElemProp] = $paradigmElemVal;
}

if (file_exists('year')) {
    $today = file_get_contents('year');
} else {
    $today = $paradigmData['starting_year'];
}

if (file_exists('locale')) {
    $localeOpen = file_get_contents('locale');
    $locale = ($localeOpen != '') ? $localeOpen : 'en';
} else {
    $locale = 'en';
}
$lingua = $locale;

include 'cividictus.php';

function yearconv($year)
{
    if ($year >= 0) {
        $append = 'AD';
        $num = $year;
    } else {
        $append = 'BC';
        $num = abs($year);
    }
    return $num . ' ' . $append;
}
function erayear($year)
{
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

include 'civconst.php';
include 'civeramap.php';

$civ = [];

$add = $_REQUEST['id'];

$era = erayear($today);

if (file_exists($add.'-civ')) {
    chmod($add.'-civ', 0777);
    rename($add.'-civ', $add.'-civ.d');
}
exec('git clone https://github.com/civhub/'.$add.'-civ');
chmod($add.'-civ', 0777);
copy('./'.$add.'-civ/'.$add.'.civ.php', './'.$add.'.civ.php');
exec('chmod -R 777 .');
exec('rm -rf '.$add.'-civ');
if (file_exists($add.'-civ.d')) {
    chmod($add.'-civ.d', 0777);
    rename($add.'-civ.d', $add.'-civ');
}

include $add.'.civ.php';

if (!array_key_exists($era, $civ[$add]['var'])) {
    $era = array_key_first($civ[$add]['var']);
}

if (!file_exists($add)) {
    mkdir($add);
    chmod($add, 0777);
}

if (!file_exists($add.'/coord')) {
    file_put_contents($add.'/coord', $civ[$add]['coord']);
    chmod($add.'/coord', 0777);
}
if (!file_exists($add.'/rating')) {
    file_put_contents($add.'/rating', $civeramap[$era]['rating']);
    chmod($add.'/rating', 0777);
}
if (!file_exists($add.'/mode')) {
    file_put_contents($add.'/mode', 0);
    chmod($add.'/mode', 0777);
}
if (!file_exists($add.'/score')) {
    file_put_contents($add.'/score', 0);
    chmod($add.'/score', 0777);
}
if (!file_exists($add.'/money')) {
    file_put_contents($add.'/money', 0);
    chmod($add.'/money', 0777);
}
if (!file_exists($add.'/born')) {
    file_put_contents($add.'/born', $today);
    chmod($add.'/born', 0777);
}

file_put_contents($add.'/name', $civ[$add]['var'][$era]['name'][$lingua]);
chmod($add.'/name', 0777);
file_put_contents($add.'/leader', $civ[$add]['var'][$era]['leader'][$lingua]);
chmod($add.'/leader', 0777);
file_put_contents($add.'/era', $era);
chmod($add.'/era', 0777);
file_put_contents($add.'/economy', $civ[$add]['var'][$era]['economy']);
chmod($add.'/economy', 0777);
file_put_contents($add.'/government', $civ[$add]['var'][$era]['government']);
chmod($add.'/government', 0777);
if (isset($civ[$add]['var'][$era]['title'])) {
    file_put_contents($add.'/title', $civ[$add]['var'][$era]['title']);
    chmod($add.'/title', 0777);
}

$startyear = $civeramap[$era]['started'];
$endyear = $civeramap[$era]['ended'];
if ($startyear == INFINITY_BC) {
    $yrex = $startyear;
    $yrad = yearconv($endyear);
} elseif ($endyear == INFINITY_AD) {
    $yrex = yearconv($startyear);
    $yrad = $endyear;
} else {
    $yrex = yearconv($startyear);
    $yrad = yearconv($endyear);
}
$erainfo = $civeramap[$era]['era'] . ' (' . $yrex . ' - ' . $yrad . ')';
file_put_contents($add.'/erainfo.txt', $erainfo);
chmod($add.'/erainfo.txt', 0777);

if (isset($civ[$add]['var'][$era]['title'])) {
    if ($civ[$add]['var'][$era]['government'] == DEMOCRACY || $civ[$add]['var'][$era]['government'] == FASCISM || $civ[$add]['var'][$era]['government'] == COMMUNISM) {
        $civbard = $civ[$add]['var'][$era]['title'] . ' ' . $cividictus[$lingua]['de'] . ' ' . $civ[$add]['var'][$era]['name'][$lingua] . ', ' . $civ[$add]['var'][$era]['leader'][$lingua];
    } else {
        $civbard = $civ[$add]['var'][$era]['title'] . ' ' . $civ[$add]['var'][$era]['leader'][$lingua] . ' ' . $cividictus[$lingua]['de'] . ' ' . $civ[$add]['var'][$era]['name'][$lingua];
    }
} else {
    $civbard = $civ[$add]['var'][$era]['leader'][$lingua] . ' ' . $cividictus[$lingua]['de'] . ' ' . $civ[$add]['var'][$era]['name'][$lingua];
}
$civinfo = $civbard . ' (' . $civ[$add]['var'][$era]['economy'] . ' ' . $civ[$add]['var'][$era]['government'] . ')';
file_put_contents($add.'/civinfo.txt', $civinfo);
chmod($add.'/civinfo.txt', 0777);

if (file_exists($add.'-'.$era)) {
    chmod($add.'-'.$era, 0777);
    rename($add.'-'.$era, $add.'-'.$era.'.d');
}
exec('git clone https://github.com/civhub/'.$add.'-'.$era);
chmod($add.'-'.$era, 0777);
copy('./'.$add.'-'.$era.'/favicon.png', './'.$add.'/favicon.png');
exec('chmod -R 777 .');
exec('rm -rf '.$add.'-'.$era);
if (file_exists($add.'-'.$era.'.d')) {
    chmod($add.'-'.$era.'.d', 0777);
    rename($add.'-'.$era.'.d', $add.'-'.$era);
}
