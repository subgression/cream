<?php
/*
  -----------------------------------------------------------------------------
  Globals.class.php
  The class that handles all the globals, stored in a binary file to keep them secure
  -----------------------------------------------------------------------------
  */

class Globals {
    const GLOBALS_PATH = __DIR__ . "/../globals.glob";
    // You should change this
    const ENC_KEY = "CreamIsTheBest";
    const ENC_METHOD = "AES-256-CBC";
    // Needs to be 16bytes long
    const ENC_IV = "CreamIsPowerful!";
    private $file = null;

    // Globals needed to be saved
    private $dbHost = null;
    private $dbName = null;
    private $dbUser = null;
    private $dbPass = null;

    function __construct() {
        // Getting globals path (if any)
        if (file_exists(Globals::GLOBALS_PATH)) {
            $this->file = fopen(Globals::GLOBALS_PATH, "r");

            // Reading JSON file
            $json = fread($this->file, filesize(Globals::GLOBALS_PATH));
            // Decrypting it
            $json = openssl_decrypt($json, Globals::ENC_METHOD, Globals::ENC_KEY, 0, Globals::ENC_IV);
            // Decoding JSON
            $data = json_decode($json);
            // Setting attributes
            $this->dbHost = $data->dbHost;
            $this->dbName = $data->dbName;
            $this->dbUser = $data->dbUser;
            $this->dbPass = $data->dbPass;

            fclose($this->file);
        }
    }

    function store() {
        $this->file = fopen(Globals::GLOBALS_PATH, "w");

        $data = new stdClass;
        $data->dbHost = $this->dbHost;
        $data->dbName = $this->dbName;
        $data->dbUser = $this->dbUser;
        $data->dbPass = $this->dbPass;
        $data = json_encode($data);
        // Encrypting data
        $data = openssl_encrypt($data, Globals::ENC_METHOD, Globals::ENC_KEY, 0, Globals::ENC_IV);

        fwrite($this->file, $data);

        fclose($this->file);
    }

    function dump() {
        echo var_dump($this);
    }

    function setDBHost($dbHost) {
        $this->dbHost = $dbHost;
    }

    function getDBHost() {
        return $this->dbHost;
    }

    function setDBName($dbName) {
        $this->dbName = $dbName;
    }

    function getDBName() {
        return $this->dbName;
    }

    function setDBUser($dbUser) {
        $this->dbUser = $dbUser;
    }

    function getDBUser() {
        return $this->dbUser;
    }

    function setDBPass($dbPass) {
        $this->dbPass = $dbPass;
    }

    function getDBPass() {
        return $this->dbPass;
    }
}
?>
