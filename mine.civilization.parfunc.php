<?php

if (file_exists($sub.'/gold')) {
    $subGold = file_get_contents($sub.'/gold');
} else {
    $subGold = 0;
}
if (file_exists($sub.'/uranium')) {
    $subUraniun = file_get_contents($sub.'/uranium');
    $subActions[] = "make_nuke";
    $subActions[] = "make_thermonuke";
} else {
    $subUranium = 0;
}
if (file_exists($sub.'/nukes')) {
    $subNukes = file_get_contents($sub.'/nukes');
    $subActions[] = "nuke";
} else {
    $subNukes = 0;
}
if (file_exists($sub.'/thermonukes')) {
    $subThermoNukes = file_get_contents($sub.'/thermonukes');
    $subActions[] = "thermonuke";
} else {
    $subThermoNukes = 0;
}
