<?php
  include "../src/CreamLoader.php";
  error_reporting(E_ALL);
  ini_set('display_errors', 'on');
  cream_loader();
  
  $name = null;
  // Name of the folder to be loaded
  if (isset($_GET['name'])) {
      $name = $_GET['name'];
  }
  if ($name == null) {
    echo "Non va la POST";
    return;
  }
  
  // ID of the gallery HTML element
  $gallery_id = "main_gallery";
  
  $creamConfig = new CreamConfig;
  $creamConfig->FetchConfig("../config.json");
  $path = "../" .$creamConfig->GetImagePathByName($name);
  // Getting paths for all images inside the folder
  $paths = [];
  foreach (glob($path . "*.{JPG,GIF,JPEG,PNG,jpg,gif,jpeg,png}", GLOB_BRACE) as $image) {
      // Removing the first ../ since is only needed to calculate here
      $image = substr($image, 3);
      array_push($paths, $image);
  }
  echo json_encode($paths);
?>
