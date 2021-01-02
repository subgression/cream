<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');
    include_once ("../../src/models/BasicResponse.model.php");
    include_once ("../../src/Stored.class.php");

    if (!isset($_SESSION['user'])) {
        $res = new BasicResponseModel(403, "User session has not been set up!");
        $res->responde();
        return -1;
    }
    else {
        if (!isset($_POST['user'])) {
            $res = new BasicResponseModel(403, "Cannot find user!");
            $res->responde();
            return -1;
        }
        if (!isset($_POST['password'])) {
            $res = new BasicResponseModel(403, "Cannot find password!");
            $res->responde();
            return -1;
        }

        // Adding admin user
        $stored = new Stored;
        $stored->open();
        
        if (!$stored->addUser($_POST['user'], hash("md5", $_POST['password']), 0)) {
            $res = new BasicResponseModel(500, "Error while creating admin user!");
            $stored->close();
            $res->responde();
            return -1;
        }
        else {
            $stored->close();
            $res = new BasicResponseModel(200, "Admin user created successfully");
            $res->responde();
        }
    }
?>