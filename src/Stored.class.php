<?php
    include_once ("Globals.class.php");

    class Stored {
        private $db = null;
        private $globals = null;
        private $connectionOpen = false;
        
        /**
         * Opens the connection with MySQL Server
         */
        function open() {
            $this->globals = new Globals;

            if (($this->db = new mysqli($this->globals->getDBHost(), $this->globals->getDBUser(), $this->globals->getDBPass())) != false) {
                $this->connectionOpen = true;
            }
            else {
                $this->connectionOpen = false;
                return false;
            }
        }

        /**
         * Checks if the database is currently created or not
         */
        function databaseExists() {
            $result = $this->db->query("SHOW DATABASES");
            while($row = $result->fetch_assoc()) {
                if ($row["Database"] == $this->globals->getDBName()) return true;
            }
            return false;
        }

        /**
         * Creates the database given the CreamDB name
         */
        function createDatabase() {
            $result = $this->db->query("CREATE DATABASE " . $this->globals->getDBName());
            return $result;
        }

        /**
         * Creates all the required to Cream to work
         */
        function createTables() {
            $this->createUserTable();
            $this->createCreamTextTable();
            $this->createCreamImageTable();
        }

        /**
         * Creates the user table where all the user will be stored
         */
        private function createUserTable() {
            $result = $this->db->query("CREATE TABLE " .$this->globals->getDBName(). ".`CreamUser` ( `ID` INT NOT NULL AUTO_INCREMENT , 
            `user` TEXT NOT NULL , `password` TEXT NOT NULL , `permission` INT NOT NULL , PRIMARY KEY (`ID`)) ENGINE = InnoDB;");
            return $result;
        }

        /**
         * Creates the Cream Text table were all the text will be stored
         */
        private function createCreamTextTable() {
            $result = $this->db->query("CREATE TABLE " .$this->globals->getDBName(). ".`CreamText` ( `id` INT NOT NULL AUTO_INCREMENT , 
            `domID` TEXT NOT NULL , `value` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
            return $result;
        }

        /**
         * Creates the Cream Image table were all the images path will be stored
         */
        private function createCreamImageTable() {
            $result = $this->db->query("CREATE TABLE " .$this->globals->getDBName(). ".`CreamImage` ( `id` INT NOT NULL AUTO_INCREMENT , 
            `domID` TEXT NOT NULL , `value` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
            return $result;
        }

        /**
         * Drops the database given the CreamDB name
         */
        function deleteDatabase() {
            $result = $this->db->query("DROP DATABASE " . $this->globals->getDBName());
            return $result;
        }

        /**
         * Closes the connection with MySQL Server
         */
        function close() {
            $this->db->close();
        }

        /**
         * Add a new user inside the CreamUser table, if the user exists, modify the entry
         * @param string $user the username
         * @param string $password the password (HASHED)
         * @param int $permission permission for this user (0 = ADMIN, 1 = REGULAR, 2 = BASIC)
         * @return true,false true if the SQL executed successfully, false if not
         */
        function addUser($user, $password, $permission) {
            if (($id = $this->userExists($user)) != -1) {
                $result = $this->db->query("UPDATE ".$this->globals->getDBName().".`CreamUser` SET `user`= '" .$user. "',
                `password`= '" .$password. "',`permission`=".$permission." WHERE ID = " .$id. "");
            }
            else {
                $result = $this->db->query("INSERT INTO " .$this->globals->getDBName(). ".`CreamUser` (`ID`, `user`, `password`, `permission`) 
                VALUES (NULL, '" .$user. "', '" .$password. "', '" .$permission. "');");
            }
            return $result;
        }

        /**
         * Check if the user will match given user and password
         * @param string $user the user to check
         * @param string $password the password to check
         */
        function matchUser($user, $password) {
            $result = $this->db->query("SELECT COUNT(*) FROM " .$this->globals->getDBName(). ".`CreamUser` WHERE user = 
            '" .$user. "' AND password = '" .$password. "'");
            while($row = $result->fetch_assoc()) {
                if ($row["COUNT(*)"] == 1) return true;
                else return false;
            }
        }

        /**
         * Checks if a certain user already exists in the CreamUser table
         * @return int -1 if the user is not found, the ID of the user if found
         */
        function userExists($user) {
            $result = $this->db->query("SELECT ID FROM " .$this->globals->getDBName(). ".`CreamUser` WHERE user = 
            '" .$user. "'");
            while($row = $result->fetch_assoc()) {
                return $row['ID'];
            }
            return -1;
        }

        /**
         * Set cream text value in the CreamText table
         * @param string $domID The ID of the cream text
         * @param string $value The current value of the cream text 
         * @return true,false true if the SQL executed successfully, false if not
         */
        function saveCreamText($domID, $value) {
            if (($id = $this->creamTextExists($domID)) != -1) {
                $result = $this->db->query("UPDATE ".$this->globals->getDBName().".`CreamText` SET `domID`= '" .$domID. "',
                `value`= '" .$value. "' WHERE ID = " .$id. "");
            }
            else {
                $result = $this->db->query("INSERT INTO " .$this->globals->getDBName(). ".`CreamText` (`ID`, `domID`, `value`) 
                VALUES (NULL, '" .$domID. "', '" .$value. "');");
            }
            return $result;
        }

        /**
         * Checks if a certain text already exists in the CreamText table
         * @return int -1 if the text is not found, the ID of the text if found
         */
        function creamTextExists($domID) {
            $result = $this->db->query("SELECT ID FROM " .$this->globals->getDBName(). ".`CreamText` WHERE domID = 
            '" .$domID. "'");
            while($row = $result->fetch_assoc()) {
                return $row['ID'];
            }
            return -1;
        }

        /**
         * Get cream text value from DB given the ID
         * @param string $domID the Cream Text ID
         * @return int,string -1 if not found, value if found
         */
        function getCreamText($domID) {
            $result = $this->db->query("SELECT * FROM " .$this->globals->getDBName(). ".`CreamText` WHERE `domID`= '" .$domID. "'");
            while($row = $result->fetch_assoc()) {
                return $row['value'];
            }
            return -1;
        }

        /**
         * Set cream image value in the CreamImage table
         * @param string $domID The ID of the cream text
         * @param string $value The current value of the cream text 
         * @return true,false true if the SQL executed successfully, false if not
         */
        function saveCreamImage($domID, $value) {
            if (($id = $this->creamImageExists($domID)) != -1) {
                $result = $this->db->query("UPDATE ".$this->globals->getDBName().".`CreamImage` SET `domID`= '" .$domID. "',
                `value`= '" .$value. "' WHERE ID = " .$id. "");
            }
            else {
                $result = $this->db->query("INSERT INTO " .$this->globals->getDBName(). ".`CreamImage` (`ID`, `domID`, `value`) 
                VALUES (NULL, '" .$domID. "', '" .$value. "');");
            }
            return $result;
        }

        /**
         * Checks if a certain text already exists in the CreamImage table
         * @return int -1 if the text is not found, the ID of the text if found
         */
        function creamImageExists($domID) {
            $result = $this->db->query("SELECT ID FROM " .$this->globals->getDBName(). ".`CreamImage` WHERE domID = 
            '" .$domID. "'");
            while($row = $result->fetch_assoc()) {
                return $row['ID'];
            }
            return -1;
        }

        /**
         * Get cream image value from DB given the ID
         * @param string $domID the Cream Text ID
         * @return int,string -1 if not found, value if found
         */
        function getCreamImage($domID) {
            $result = $this->db->query("SELECT * FROM " .$this->globals->getDBName(). ".`CreamImage` WHERE `domID`= '" .$domID. "'");
            while($row = $result->fetch_assoc()) {
                return $row['value'];
            }
            return -1;
        }
    }
?>