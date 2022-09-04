<?php

function parseArrayFile($name): array {
    $str = file_get_contents($name);
    $arr = explode('|[1]|', $str);
    $obj = [];
    foreach ($arr as $line) {
        $div = explode('|[>]|', $line);
        $prop = $div[0];
        $val = $div[1];
        $obj[$prop] = $val;
    }
    
    return $obj;
}

function parseGetData($data): array {
    $parse = explode('|[1]|', $data);
    $arr = [];
    foreach ($parse as $load) {
        $line = explode('|[>]|', $load);
        $prop = $line[0];
        $value = $line[1];
        $arr[$prop] = $value;
    }
    
    return $arr;
}

function gitExecute($host = 'https://github.com', $repo, $branch, $user) {
    if (file_exists($repo)) {
        chmod($repo, 0777);
        unlink($repo);
    }
    if ($branch != '') {
        exec('git clone -b '.$branch.' '.$host.'/'.$user.'/'.$repo);
    } else {
        exec('git clone '.$host.'/'.$user.'/'.$repo);
    }
    exec('chmod -R 777 .');
    chmod($repo, 0777);
}

function gitPerform($host = 'https://github.com', $repo, $branch, $user, $file, $dest, $name) {
    if (file_exists($repo)) {
        chmod($repo, 0777);
        rename($repo, $repo.'.d');
    }
    if ($branch != '') {
        exec('git clone -b '.$branch.' '.$host.'/'.$user.'/'.$repo);
    } else {
        exec('git clone '.$host.'/'.$user.'/'.$repo);
    }
    exec('chmod -R 777 .');
    chmod($repo, 0777);
    gitOperation($repo, $file, $dest, $name);
    exec('chmod -R 777 .');
    exec('rm -rf '.$repo);
    if (file_exists($repo.'.d')) {
        chmod($repo.'.d', 0777);
        rename($repo.'.d', $repo);
    }
}

function gitOperation($repo, $filename, $dest, $newname) {
    if (file_exists('./'.$repo.'/'.$filename)) {
        copy('./'.$repo.'/'.$filename, './'.$dest.'/'.$newname);
        chmod('./'.$dest.'/'.$newname, 0777);
    }
}

if (file_exists('paradigm')) {
    $paradigm = file_get_contents('paradigm');
} else {
    $paradigm = 'default';
}
$paradigmData = parseArrayFile($paradigm.'.par');
if (file_exists('year')) {
    $today = file_get_contents('year');
} else {
    $today = $paradigmData['default_year'];
}
if (file_exists('locale')) {
    $localeOpen = file_get_contents('locale');
    $locale = ($localeOpen != '') ? $localeOpen : $paradigmData['default_zone'];
} else {
    $locale = $paradigmData['default_zone'];
}
$lingua = $locale;

$civiductus = [];
include $lingua.'.cividictus.php';

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
$dataString = $_REQUEST['data'];

$objMeta = parseGetData($dataString);

gitPerform('https://github.com', $add.'-civ', '', 'civhub', $add.'.civ.php', $add, $add.'.civ.php');

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
    file_put_contents($add.'/mode', $$paradigmData['default_mode']);
    chmod($add.'/mode', 0777);
}
if (!file_exists($add.'/score')) {
    file_put_contents($add.'/score', $paradigmData['default_score']);
    chmod($add.'/score', 0777);
}
if (!file_exists($add.'/money')) {
    file_put_contents($add.'/money', $paradigmData['default_money']);
    chmod($add.'/money', 0777);
}
if (!file_exists($add.'/born')) {
    file_put_contents($add.'/born', $today);
    chmod($add.'/born', 0777);
}
file_put_contents($add.'/locale', $lingua);
chmod($add.'/locale', 0777);
file_put_contents($add.'/zones', $paradigmData['default_zones']);
chmod($add.'/zones', 0777);
$lallzones = explode(',', $paradigmData['default_zones']);
foreach ($lallzones as $key=>$value) {
    if (!file_exists($add.'/'.$value.'.cur')) {
        file_put_contents($add.'/'.$value.'.cur', $paradigmData['default_currency_sign']);
        chmod($add.'/'.$value.'.cur', 0777);
    }
    if (!file_exists($add.'/'.$value.'.curval')) {
        file_put_contents($add.'/'.$value.'.curval', $paradigmData['default_currency_value']);
        chmod($add.'/'.$value.'.curval', 0777);
    }
}

if (!file_exists($add.'/home.coord')) {
    file_put_contents($add.'/home.coord', $civ[$add]['coord']);
    chmod($add.'/home.coord', 0777);
}
file_put_contents($add.'/settle.coord', $civ[$add]['coord']);
chmod($add.'/settle.coord', 0777);

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

gitPerform('https://github.com', $add.'-ico', 'main', 'civhub', 'era-'.$era.'.png', $add, 'favicon.png');
if (isset($objMeta['weapon'])) {
    gitPerform('https://github.com', 'equipment', $paradigm, 'wholemarket', $objMeta['weapon'].'.weapon.obj', $add, $objMeta['weapon'].'.weapon.obj');
}
if (isset($objMeta['shield'])) {
    gitPerform('https://github.com', 'equipment', $paradigm, 'wholemarket', $objMeta['shield'].'.shield.obj', $add, $objMeta['shield'].'.shield.obj');
}
