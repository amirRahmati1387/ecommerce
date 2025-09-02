<?php

include("autoload.php");
include("roter.php");

$roter = new roter($key);
$roterKey = $roter -> uriArray();

$loadFile = factory :: factory("loadFile");
$loadFile -> loadFile("header");
$loadFile -> loadFile($roterKey[2]);
$loadFile -> loadFile("footer");