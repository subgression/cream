<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');
    include_once ("../../src/models/BasicResponse.model.php");
    include_once ("../../src/Stored.class.php");
    include_once ("../../src/Globals.class.php");

    if (!isset($_SESSION['user'])) {
        $res = new BasicResponseModel(403, "User session has not been set up!");
        $res->responde();
        return -1;
    }
    else {
        if (!isset($_POST['dbHost'])) {
            $res = new BasicResponseModel(403, "Cannot find dbHost!");
            $res->responde();
            return -1;
        }
        if (!isset($_POST['dbName'])) {
            $res = new BasicResponseModel(403, "Cannot find dbName!");
            $res->responde();
            return -1;
        }
        if (!isset($_POST['dbUser'])) {
            $res = new BasicResponseModel(403, "Cannot find dbUser!");
            $res->responde();
            return -1;
        }
        if (!isset($_POST['dbPass'])) {
            $res = new BasicResponseModel(403, "Cannot find dbPass!");
            $res->responde();
            return -1;
        }

        // Updating globals
        $globals = new Globals;
        $globals->setDBHost($_POST['dbHost']);
        $globals->setDBName($_POST['dbName']);
        $globals->setDBUser($_POST['dbUser']);
        $globals->setDBPass($_POST['dbPass']);
        $globals->store();

        // Creating the database
        $stored = new Stored;
        $stored->open();
        $stored->createDatabase();
        $stored->createTables();
        $stored->close();

        $res = new BasicResponseModel(200, "Cream Database has been created successfully!");
        $res->responde();
    }

?>