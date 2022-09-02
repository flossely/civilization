<?php

$subActions = ["pass"];
$subActionCount = count($subActions);
$subAction = $subActions[rand(0, $subActionCount - 1)];

if ($subAction == "pass") {
    echo $turnNum." : ".$subFullName.' '.$spacedictus[$proLingo]["pass"]."<br>";
}
