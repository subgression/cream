<?php
include "../src/CreamLoader.php";
error_reporting(E_ALL);
ini_set('display_errors', 'on');
cream_loader();

$creamConfig = new CreamConfig;
$creamConfig->FetchConfig("../config.json");

echo json_encode($creamConfig->GetAllImagePaths());
?>