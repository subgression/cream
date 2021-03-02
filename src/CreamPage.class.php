<?php
    /*
    -----------------------------------------------------------------------------
    CreamPage.class.php
    Defines a Cream capable Page, aka a PHP page with values that can be
    changed by having delimeters inside of it
    -----------------------------------------------------------------------------
    */
    require_once("utils/CreamDelimiter.utils.php");

    class CreamPage {
        var $name = null;
        var $src = null;
        var $page_src = null;
        var $valid = false;

        /**
         * Construct the cream page and checks if the page is valid or not
         */
        function __construct($src) {
            $this->src = $src;
            $this->page_src = file_get_contents(__DIR__ . "/../../" . $src);
            $this->name = CreamDelimiter::GetTag($this->page_src, "PageName");
            if ($this->name != null) $this->valid = true;
        }
    }
