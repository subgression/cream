<?php
    /**
     * Loads the cream instance for PHP
     */
    function cream_loader() {
        // To enable error reporting
        require_once("Debugger.php");
        // Including Cream Class
        require_once("Cream.class.php");
        require_once("Stored.class.php");
        require_once("FileManager.class.php");
        require_once("CreamTopping.class.php");
        // Including all the UI components
        include_once("ui/sidebar.component.php");
        include_once("ui/footer.component.php");
        include_once("ui/imageupload.component.php");
        include_once("ui/gallery.component.php");
        // Including script and link loader
        include_once("loaders/script_loader.php");
        include_once("loaders/link_loader.php");

        
    }
?>