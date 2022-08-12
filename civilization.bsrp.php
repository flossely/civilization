<?php

// GETTING CURRENT YEAR FROM FILE
if (file_exists('year')) {
    $today = file_get_contents('year');
} else {
    $today = -2000;
}

// GETTING CURRENT LOCALE FROM FILE
if (file_exists('locale')) {
    $localeOpen = file_get_contents('locale');
    $locale = ($localeOpen != '') ? $localeOpen : 'en';
} else {
    $locale = 'en';
}
$lingua = $locale;

// OPEN CIV VOCABULARY
include 'cividictus.php';

// FUNCTIONS USED IN THE SCRIPT
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

// ACCESING CONSTANTS AND ERA-DEPENDENT DATA
include 'civconst.php';
include 'civeramap.php';

// DEFINE THE CIV ARRAY VARIABLE
$civ = [];

// GET CIV ID FROM HTTP REQUEST
$add = $_REQUEST['id'];

// GETTING ERA VALUE BY THE CURRENT YEAR
$era = erayear($today);

// DOWNLOADING SELECTED CIV DATA FILE
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

// INCLUDE CURRENT CIV DATA FROM DOWNLOADED FILE
include $add.'.civ.php';

// OVERRIDE CURRENT ERA VALUE IF NOT EXISTING IN CURRENT CIV DATA ARRAY
if (!array_key_exists($era, $civ[$add]['var'])) {
    $era = array_key_first($civ[$add]['var']);
}

// CREATE CIV DIRECTORY IF NOT EXISTING
if (!file_exists($add)) {
    mkdir($add);
    chmod($add, 0777);
}

// SET CIV PARAMETERS IF THEY NOT EXIST TO PREVENT OVERRIDE BY NEW CIV QUERY
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

// OVERRIDING CIV DATA WITH THOSE OF THE ERA OF CURRENT YEAR
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

// CREATING ERA INFO FOR SELECTED CIV
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

// CREATING CIV INFO
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

// DOWNLOADING CIV FLAG AND SETTING IT AS ICON
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
