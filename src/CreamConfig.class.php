<?php
/*
  -----------------------------------------------------------------------------
  CreamConfig.class.php
  This class will handle all configs that resides in config.json
  -----------------------------------------------------------------------------
  */
?>

<?php
    class CreamConfig {
        public $configs = null;
        /**
         * Fetches the config from the JSON file, call this before ANY operation
         * @param: Relative path from the caller component to the correct location
         * @return string
         */
        public function FetchConfig($path) {
            $this->configs = json_decode(file_get_contents($path));
            return file_get_contents($path);
        }
        /**
         * Returns all the images path (and names) from config.json
         * @return object[]
         */
        public function GetAllImagePaths() {
            $paths = [];

            foreach($this->configs->creamImageFiles as $cif) {
                $path = new stdClass;

                $path->path = $cif->path;
                $path->name = $cif->name;
                array_push($paths, $path); 
            }

            return $paths;
        }

        /**
         * Returns the image path for any given name (or null if not found)
         * @param string $name the abstract name of the folder (in cream config);
         * @return string
         */
        public function GetImagePathByName($name) {
            foreach($this->configs->creamImageFiles as $cif) {
                if ($cif->name == $name) return $cif->path;
            }
            return null;
        }
    }
?>