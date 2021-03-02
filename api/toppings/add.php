<?php
    include_once("./src/CreamLoader.php");
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');
    require_once("../../src/CreamTopping.class.php");
    require_once("../../src/JSONDB.class.php");
    require_once("../../src/models/BasicResponse.model.php");
    require_once("../../src/utils/guid.utils.php");
    require_once("../../src/utils/CreamLogger.utils.php");

    $jsondb = new JSONDB;

    $t = null;
    if (isset($_POST['t'])) {
        $t = $_POST['t'];
    }
    else {
        $res = new BasicResponseModel(1001, "The topping value is not defined");
        $res->responde();
        return;
    }

    echo "Getting topping via ID: " .$t. " \n";
    CreamLogger::Log(ELoggerLevel::INFO, "Getting topping via ID: " .$t, "Add Topping API");

    $topping = $jsondb->GetToppingByID($t);
    $keys = array();
    $vals = array();
    for ($i = 0; $i < $topping->inner_topping_size; $i++) {
        array_push($keys, GUID::new());
        array_push($vals, "DEFAULT");
    }

    // Creating the new topping and pushing it inside of the DB
    $topping->AddInnerTopping(new InnerTopping($keys, $vals, $topping->template));
    CreamLogger::Log(ELoggerLevel::INFO, "Adding a new topping, total in Topping " .$t. ": " .count($topping->inner_toppings), "Add Topping API");
    $jsondb->SaveTopping($topping);
?>