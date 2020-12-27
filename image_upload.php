<!DOCTYPE html>
<?php
include "src/CreamLoader.php";
error_reporting(E_ALL);
ini_set('display_errors', 'on');
cream_loader();
?>
<?php  ?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Cream Manager | Dashboard </title>
    <?php cream_import_links(); ?>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php cream_render_sidebar(); ?>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-expand">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                    <p class="page-indicator">Gallery</p>


                </div>
            </nav>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 text-center" style="display: flex; justify-content: center; align-item: center;">
                        <?php cream_render_img_upload(); ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>


    <?php cream_render_footer(); ?>
    <?php cream_import_scripts(); ?>
</body>

</html>