<!DOCTYPE html>
<?php
    include "src/CreamLoader.php";
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
                    <p class="page-indicator">Home</p>
                </div>
            </nav>
        </div>
    </div>

    <?php cream_import_scripts(); ?>
</body>

</html>
