<?php
  require '../../config.php';

  if (isset($_POST['ids']) and
      isset($_POST['values']) and
      isset($_POST['names']) and
      isset($_POST['pageName']))
  {
    $page_name = $_POST['pageName'];

    /*
    $ids_arr = $_POST['ids'];
    $idfile = fopen("../mt_files/".$page_name."_id.json", "w") or die("Impossibile creare il file!");
    fwrite($idfile, $ids_arr);
    fclose($idfile);

    $values_arr = $_POST['values'];
    $valuefile = fopen("../mt_files/".$page_name."_value.json", "w") or die("Impossibile creare il file!");
    fwrite($valuefile, $values_arr);
    fclose($valuefile);

    $names_arr = $_POST['names'];
    $namefile = fopen("../mt_files/".$page_name."_name.json", "w") or die("Impossibile creare il file!");
    fwrite($namefile, $names_arr);
    fclose($namefile);
    */

    $fullfile = fopen("../mt_files/".$page_name.".json", "w") or die("Impossibile creare il file!");

    $ids_json = $_POST['ids'];
    $values_json = $_POST['values'];
    $names_json = $_POST['names'];
    $ids_arr = json_decode($ids_json, true);
    $values_arr = json_decode($values_json, true);
    $names_arr = json_decode($names_json, true);
    $json_arr = Array();

    for ($i = 0; $i < count($ids_arr); $i++)
    {
        array_push($json_arr, array("id" => $ids_arr[$i], "name" => $names_arr[$i], "value" => $values_arr[$i]));
    }
    fwrite($fullfile, json_encode($json_arr));
    fclose($fullfile);
  }
?>
