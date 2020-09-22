<?php
  if (isset($_POST['pageName']))
  {
    $page_name = $_POST['pageName'];
    $file_str = "../mt_files/".$page_name.".json";
    $idfile = fopen($file_str, "r") or die("NULL");
    echo fread($idfile, filesize($file_str));
    fclose($idfile);
  }
?>
