<?php
    require_once("utils/CreamDelimiter.utils.php");
    require_once("utils/guid.utils.php");
    require_once("FileManager.class.php");
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    /*
    -----------------------------------------------------------------------------
    CreamTopping.class.php
    Defines a topping, aka a templatable HTML snippet with values that can be
    changed by having delimeters inside of it
    -----------------------------------------------------------------------------
    */
    class CreamTopping {
        // The template name and value
        public $template_name = null;
        public $template = null;

        // If the topping is defaulted atm
        //public $defaults = true;

        // The inner toppings that will define a single element
        public $inner_toppings = array();

        // Data for the topping
        public $name;
        public $tags = array();

        // Counter of how many keys and val will be stored for each inner topping
        public $inner_topping_size = 0;

        /**
         * Construct the template directly by calling the constructor (probably)
         * @param string $template_name The name of the template (including the extension)
         */
        function __construct($template_name) {
            // Locating template (if found)
            if (($this->template = file_get_contents(__DIR__ . "/../toppings/" . $template_name)) == null) {
                echo 'Cannot locate template! <br>';
                return;
            }

            $this->template_name = $template_name;
            $this->name = CreamDelimiter::GetTag($this->template, "ToppingName");
            $this->inner_topping_size = $this->GetInnerToppingSize();

            // Getting all the tags from the topping
            $this->getInnerTags();
        }

        /**
         * Creates a new instance of topping from the JSONDB
         * @param stdClass $val The json value
         * @return CreamTopping The topping created
         */
        static function FromJSONDB($val) {
            $topping = new CreamTopping($val->template_name);
            for ($i = 0; $i < count($val->inner_toppings); $i++) {
                $topping->AddInnerTopping($val->inner_toppings[$i]);
            }
            return $topping;
        }

        /**
         * Calculates how many keys and values are necessary for each inner topping
         * @return int $inner_topping_size the count of data for each inner topping
         */
        function GetInnerToppingSize() {
            $inner_topping_size = 0;
            $matches = array();
            preg_match_all('/(?<={{)(.*?)(?=}})/', $this->template, $matches);
            foreach ($matches[0] as $match) {
                $is_id = substr($match, 0, 3);

                if (strcmp($is_id, "id_") === 0) {
                    $inner_topping_size++;
                }
            }
            return $inner_topping_size;
        }

        function Build() {
            //echo var_dump($this->inner_toppings);
            for ($i = 0; $i < count($this->inner_toppings); $i++) {
                $this->inner_toppings[$i]->Build();
            }
        }

        /**
         * Get the inner tags (id_tag_name and tag_name)
         * the id_tag will define the guid
         * the tag will define the proper value based on the guid
         */
        function getInnerTags() {
            // Matches all {{text}}
            $matches = array();
            preg_match_all('/(?<={{)(.*?)(?=}})/', $this->template, $matches);
            foreach ($matches[0] as $match) {
                $is_id = substr($match, 0, 3);

                if (strcmp($is_id, "id_") === 0) {
                    // Getting the corresponding value
                    $id_val = substr($match, 3);

                    $toppingTag = new ToppingTag(GUID::new(), $match, $id_val);
                    array_push($this->tags, $toppingTag);
                }
            }
        }

        /**
         * Adds a new inner topping from
         * @param InnerTopping the innertopping to add
         */
        function AddInnerTopping($it) {
            $innerTopping = new InnerTopping($it->keys, $it->vals, $it->template);
            array_push($this->inner_toppings, $innerTopping);
        }
    }

    class InnerTopping {
        // All the keys (GUID) in the corresponding inner topping
        var $keys = array();
        // All the values for the corresponding (same index) keys
        var $vals = array();
        // The template to be used
        var $template = null;
        // The ids for all the tags that will be replaced
        var $ids = array();
        // The values of the template that will be replaced with the real values
        var $temp_vals = array();

        /**
         * Creates the inner topping itself
         * @param array $keys The keys for the current inner topping
         * @param array $vals The values of the current inner topping
         * @param string $template the current template to be used when creating a single inner topping
         */
        function __construct($keys, $vals, $template) {
            $this->keys = $keys;
            $this->vals = $vals;
            $this->template = $template;
            $this->ids = $this->GetTemplateIDS();
            $this->temp_vals = $this->FromIDSToTempVals();
        }

        /**
         * Gets all the template ids in the current template
         * @return array $ids all the ids found via regex
         */
        function GetTemplateIDS() {
            $t = array();
            $matches = array();
            preg_match_all('/(?<={{)(.*?)(?=}})/', $this->template, $matches);
            foreach ($matches[0] as $match) {
                $is_id = substr($match, 0, 3);
                if (strcmp($is_id, "id_") === 0) {
                    array_push($t, $match);
                }
            }
            return $t;
        }

        /**
         * Converts a list of IDS to a list of temp values
         * to be replaced inside of the cream inner topping
         * @return array $temp_vals all the temp values needed
         */
        function FromIDSToTempVals() {
            $tv = array();
            foreach ($this->ids as $id) {
                $temp_val = substr($id, 3, strlen($id));
                array_push($tv, $temp_val);
            }
            return $tv;
        }

        /**
         * Builds the current inner topping
         */
        function Build() {
            // For all ids, replace the id and the value with the given key
            for ($i = 0; $i < count($this->keys); $i++) {
                // Replacing the id with the correct key
                $this->template = str_replace('{{'.$this->ids[$i].'}}', $this->keys[$i], $this->template);
                // Replacing the temp_val with the correct val
                $this->template = str_replace('{{'.$this->temp_vals[$i].'}}', $this->vals[$i], $this->template);   
            } 
            echo $this->template;
        }
    }

    class ToppingTag {
        var $guid = null;
        var $topping_id = null;
        var $val = null;

        // Defines a topping tags, to be used in the inner topping
        function __construct($guid, $topping_id, $val) {
            $this->guid = $guid;
            $this->topping_id = $topping_id;
            $this->val = $val;
        }
    }
