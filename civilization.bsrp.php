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

function intoZone($id) {
    $dir = '.';
    $list = str_replace($dir.'/','',(glob($dir.'/*.locale')));
    
    foreach ($list as $key=>$value) {
        $zcut = basename($value, '.locale');
        $zcon = file_get_contents($value);
        $zcur = explode(' ', $zcon)[1];
        $zcurval = explode(' ', $zcon)[0];
        file_put_contents($id.'/'.$zcut.'.cur', $zcur);
        chmod($id.'/'.$zcut.'.cur', 0777);
        if (is_numeric($zcurval)) {
            file_put_contents($id.'/'.$zcut.'.curval', $zcurval);
            chmod($id.'/'.$zcut.'.curval', 0777);
        } else {
            file_put_contents($id.'/'.$zcut.'.curval', 1);
            chmod($id.'/'.$zcut.'.curval', 0777);
        }
    }
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
    $paradigm = 'system';
}
$paradigmData = parseArrayFile($paradigm.'.par');
if (file_exists('year')) {
    $today = file_get_contents('year');
} else {
    $today = $paradigmData['default_year'];
}
$lazones = str_replace('./','',(glob('./*.locale')));
if (file_exists('locale')) {
    $locale = file_get_contents('locale');
} else {
    $locale = basename(array_key_first($lazones), '.locale');
}
$lingua = $locale;
if (file_exists('mode')) {
    $mode = file_get_contents('mode');
} else {
    $mode = $paradigmData['default_mode'];
}

$add = $_REQUEST['id'];
$data = $_REQUEST['data'];

$meta = parseGetData($data);

if (!file_exists($add)) {
    mkdir($add);
    chmod($add, 0777);
}

if (!file_exists($add.'/coord')) {
    file_put_contents($add.'/coord', $paradigmData['default_coord']);
    chmod($add.'/coord', 0777);
}
if (!file_exists($add.'/rating')) {
    file_put_contents($add.'/rating', $paradigmData['default_rating']);
    chmod($add.'/rating', 0777);
}
file_put_contents($add.'/mode', $mode);
chmod($add.'/mode', 0777);
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
intoZone($add);

if (isset($meta['name'])) {
    file_put_contents($add.'/name', $meta['name']);
    chmod($add.'/name', 0777);
}

if (isset($meta['leader'])) {
    file_put_contents($add.'/leader', $meta['leader']);
    chmod($add.'/leader', 0777);
}

if (isset($meta['item'])) {
    gitPerform('https://github.com', 'thingy', 'main', 'wholemarket', $meta['item'].'.item.obj', $add, $meta['item'].'.item.obj');
}

if (isset($meta['civ'])) {
    if (isset($meta['era'])) {
        gitPerform('https://github.com', $meta['civ'], '', 'civhub', $meta['era'].'.png', $add, 'favicon.png');
    } else {
        gitPerform('https://github.com', $meta['civ'], '', 'civhub', 'favicon.png', $add, 'favicon.png');
    }
}
