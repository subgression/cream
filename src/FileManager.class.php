<?php
  /*
  -----------------------------------------------------------------------------
  FileManager.class.php
  This class handles all I/O operation beetween Cream files
  -----------------------------------------------------------------------------
  */
  class FileManager {
    /*
    -----------------------------------------------------------------------------
    Returns all the html files present in the root folder
    -----------------------------------------------------------------------------
    */
    public function GetHtmlFiles()
    {
      echo "Getting HTML files...";
      $files = array();

      foreach (glob("../../*.*") as $filename) {
        //Taking the last part only
        $exploded = explode("/", $filename);
        $filename = end($exploded);

        //Chceking file extsnsion
        if ($this->CheckFileExtension($filename))
        {
          array_push($files, $filename);
        }
      }

      return $files;
    }

    /*
    -----------------------------------------------------------------------------
    Check if the filename has a valid extension (.html, .php)
    $filename: the filename to be checked
    -----------------------------------------------------------------------------
    */
    private function CheckFileExtension($filename)
    {
      $comma_separated = explode(".", $filename);
      $extension = end($comma_separated);

      if ($extension == "html" or $extension == "php")
      {
          return true;
      }

      return false;
    }

    /*
    -----------------------------------------------------------------------------
    Check if a proper text file is present into CreamText
    $id: the id to check
    -----------------------------------------------------------------------------
    */
    public function CheckTextFileById($id)
    {
        $textfiles = scandir("./cream/creamtext", 1);
        foreach ($textfiles as $textfile) {
            if ($textfile == $id) return true;
        }
        return false;
    }

    /*
    -----------------------------------------------------------------------------
    Check if a proper image file is present into CreamImage
    $id: the id to check
    -----------------------------------------------------------------------------
    */
    public function CheckImageFileById($id)
    {
        $textfiles = scandir("./cream/creamimage", 1);
        foreach ($textfiles as $textfile) {
            if ($textfile == $id) return true;
        }
        return false;
    }

    /*
    -----------------------------------------------------------------------------
    Save a text file by a given id and a value
    $id: the id to save
    $value: the text value for the id
    -----------------------------------------------------------------------------
    */
    public function SaveTextFileById($id, $value)
    {
        $idFile = fopen("./cream/creamtext/" . $id, "w");
        fwrite($idFile, $value);
    }

    /*
    -----------------------------------------------------------------------------
    Save an image file by a given id and a value
    $id: the id to save
    $value: the text value for the id
    -----------------------------------------------------------------------------
    */
    public function SaveImageFileById($id, $value)
    {
        $idFile = fopen("./cream/creamimage/" . $id, "w");
        fwrite($idFile, $value);
    }

    /*
    -----------------------------------------------------------------------------
    Save a text file by a given id and a value
    $id: the id to save
    $value: the text value for the id
    -----------------------------------------------------------------------------
    */
    public function GetTextFileById($id)
    {
        $idFileDir = "./cream/creamtext/" . $id;
        return file_get_contents($idFileDir);
    }

    /*
    -----------------------------------------------------------------------------
    Save a image file by a given id and a value
    $id: the id to save
    $value: the text value for the id
    -----------------------------------------------------------------------------
    */
    public function GetImageFileById($id)
    {
        $idFileDir = "./cream/creamimage/" . $id;
        return file_get_contents($idFileDir);
    }
  }
  $FileManager = new FileManager;
?>
