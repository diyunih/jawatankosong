<?php
session_start();
$timestamp = $_SERVER['REQUEST_TIME'];
$setting = json_decode(file_get_contents("_rules.json"), TRUE);
$CCODE  = $setting["ccode"];
$TITLE  = $setting["title"];
$BOTKN  = $setting["token"];
$ADMID  = $setting["admid"];
$track  = json_decode(file_get_contents("API/tracker.json"), TRUE);
?>