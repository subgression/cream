<?php
  /*
  -----------------------------------------------------------------------------
  JSONDB.class.php
  This class handles all I/O operation beetween Cream files
  -----------------------------------------------------------------------------
  */
  class JSONDB {
      private $db = null;
      private $textIDs = null;
      private $imgIDs = null;
      /**
       * Returns the DB instance
       * @param: $textIDs All the textIDs in the page
       * @param: $imgIDs All the imgIDs in the page
       * @param: $pageName The page name
       * @todo: Keep DB in shared memory
      */
      public function CreateDB($textIDs, $imgIDs, $pageName) {
        $this->db = new stdClass;
        $this->db->pageName = $pageName;
        $this->db->textIDs = $textIDs;
        $this->db->imgIDs = $imgIDs;

        $this->textIDs = $textIDs;
        $this->imgIDs = $imgIDs;
      }

      /**
       * Saves the DB on a local file 
       */
      public function SaveDB() {
        if ($encoded = (json_encode($this->db)) != null) {
            $file = fopen("../../creamjson/db.json", "w");
            fwrite($file, $encoded);
            fclose($file);
        }
      }

      /**
       * Gets the DB from the local file
       */
      public function GetDB() {
        $file = file_get_contents('../../creamjson/db.json');
        $this->db = json_decode($file, true);
      }

      /**
       * Check Text by ID
       * @param $id The id to check
       * @return ( true | false )
       */
      public function CheckTextByID($id) {
        if ($this->db == null) {
            $this->GetDB();
            if ($this->db == null) {
                echo "Cannot GET DB, fatal error!";
                return false;
            }
        }
        if (isset($this->db[$id])) {
            return true;
        }
        return false;
      }

      /**
       * Check Text by ID
       * @param $id The id to check
       * @return ( true | false )
       */
      public function GetTextByID($id) {
        if ($this->db == null) {
            $this->GetDB();
            if ($this->db == null) {
                echo "Cannot GET DB, fatal error!";
                return false;
            }
        }
        if (isset($this->db[$id])) {
            return true;
        }
        return false;
      }
  }