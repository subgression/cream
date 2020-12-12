<?php
    /**
     * Loads the cream instance for PHP
     */
    function cream_loader() {
        error_reporting(E_ALL);
        ini_set('display_errors', 'on');
        // Including Cream Class
        require "Cream.class.php";
        // Including all the UI components
        include "ui/sidebar.component.php";
        // Including script and link loader
        include "loaders/script_loader.php";
        include "loaders/link_loader.php";
    }
?>