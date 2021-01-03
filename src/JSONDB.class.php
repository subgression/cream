<?php
/*
  -----------------------------------------------------------------------------
  JSONDB.class.php
  This class handles all I/O operation beetween Cream files using a JSON Database
  Is used whenever the client doesen't have, or need a MySQL database
  -----------------------------------------------------------------------------
  */
class JSONDB {
	private $db = null;
	private $textIDs = null;
	private $imgIDs = null;

	/**
	 * Saves the DB on a local file 
	 */
	public function SaveDB() {
		if (($encoded = json_encode($this->db)) != null) {
			$file = fopen(__DIR__ . "/../creamdb.json", "w");
			fwrite($file, $encoded);
			fclose($file);
		}
		else {
			echo "Cannot save DB \n";
		}
	}

	/**
	 * Gets the DB from the local file
	 */
	public function GetDB() {
		// If the creamdb does not exist yet, create it
		if (!file_exists(__DIR__ . "/../creamdb.json")) {
			$newdb = fopen(__DIR__ . "/../creamdb.json", "w");

			$emptyDB = new stdClass;
			$emptyDB->creamText = [];
			$emptyDB->creamImage = [];
			fwrite($newdb, json_encode($emptyDB));

			fclose($newdb);
			return true;
		}
		else {
			$contents = file_get_contents(__DIR__ . "/../creamdb.json");
			$this->db = json_decode($contents);
			return true;
		}
		return false;
	}

	/**
	 * Check Text by ID
	 * @param $id The id to check
	 * @return ( true | false )
	 */
	public function CheckTextByID($id) {
		$this->GetDB();
		if ($this->db == null) return false;
		if ($this->db->creamText == null) return false;

		foreach ($this->db->creamText as $ct) {
			if ($ct->id == $id) return true;
		}
		return false;
	}

	/**
	 * Check Image by ID
	 * @param $id The id to check
	 * @return ( true | false )
	 */
	public function CheckImageByID($id) {
		$this->GetDB();
		if ($this->db == null) return false;
		if ($this->db->creamImage == null) return false;

		foreach ($this->db->creamImage as $ct) {
			if ($ct->id == $id) return true;
		}
		return false;
	}

	/**
	 * Get Text given an ID
	 * @param $id The id to check
	 * @return ( string | false )
	 */
	public function GetTextByID($id) {
		if ($this->db == null) {
			$this->GetDB();
			if ($this->db == null) {
				echo "Cannot GET DB, fatal error!";
				return false;
			}
		}
		foreach ($this->db->creamText as $ct) {
			if ($ct->id == $id) {
				return $ct->val;
			}
		}
		return false;
	}

	/**
	 * Get Image given an ID
	 * @param $id The id to check
	 * @return ( string | false )
	 */
	public function GetImageByID($id) {
		if ($this->db == null) {
			$this->GetDB();
			if ($this->db == null) {
				echo "Cannot GET DB, fatal error!";
				return false;
			}
		}
		foreach ($this->db->creamImage as $ct) {
			if ($ct->id == $id) {
				return $ct->val;
			}
		}
		return false;
	}

	/**
	 * Saves the text value inside the creamdb.json
	 * @param string $id the id of the cream text
	 * @param string $val the value of the cream text
	 */
	public function SaveTextById($id, $val) {
		$this->GetDB();
		$creamText = new stdClass;
		$creamText->id = $id;
		$creamText->val = $val;
		
		$creamIDfound = false;
		foreach ($this->db->creamText as $ct) {
			if ($ct->id == $creamText->id) {
				$ct->val = $creamText->val;
				$creamIDfound = true;
			}
		}
		if (!$creamIDfound) {
			array_push($this->db->creamText, $creamText);
		}
		$this->SaveDB();
	}

	/**
	 * Saves the image src inside the creamdb.json
	 * @param string $id the id of the cream text
	 * @param string $val the value of the cream text
	 */
	public function SaveImageById($id, $val) {
		$this->GetDB();
		$creamImage = new stdClass;
		$creamImage->id = $id;
		$creamImage->val = $val;
		
		$creamIDfound = false;
		foreach ($this->db->creamImage as $ct) {
			if ($ct->id == $creamImage->id) {
				$ct->val = $creamImage->val;
				$creamIDfound = true;
			}
		}
		if (!$creamIDfound) {
			array_push($this->db->creamImage, $creamImage);
		}
		$this->SaveDB();
	}
}
