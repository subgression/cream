<!DOCTYPE html>
<?php
include "src/CreamLoader.php";
cream_loader();
?>
<html>
<?php
//Looks for a GET request, telling what page to load
$pagestr = '';
if (isset($_GET['page'])) {
    $pagestr = $_GET['page'];
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Cream Manager | Utilities </title>

    <?php cream_import_links(); ?>
</head>

<body>
    <div class="wrapper">
        <?php cream_render_sidebar(); ?>

        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-expand">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                    <p class="page-indicator"> Utilities</p>
                </div>
            </nav>

            <!-- Utilities Container -->
            <div class="container">
                <div class="row">
                    <!-- HTML to CC.PHP Converter Start -->
                    <div class="col-lg-6">
                        <h2 class="mb-4"> Auto-Convert HTML pages to Cream Capable HTML Pages </h2>
                        <p>
                            This utility will replace all html tags (compatible with Cream) in all .html pages in a cc.php page (Cream Compatible PHP). <br>
                            <span style="color: red; font-weight: bolder"> WARNING! </span> This utility will require 777 permission inside of the root folder of the
                            web server, and will destroy all .html pages by replacing them, be sure to have a backup!!!!!
                        </p>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="cream-check-conversion">
                            <label class="form-check-label" for="cream-check-conversion">I've understood!</label>
                        </div>
                        <button type="button" id="sidebarCollapse" class="btn btn-expand mt-5" disabled>
                            <i class="fas fa-align-left"></i>
                            <span class="ml-2"> Convert Pages!!</span>
                        </button>
                        <hr>
                    </div>
                    <!-- HTML to CC.PHP Converter Start -->
                    <div class="col-lg-6">
                        <h2 class="mb-4"> Cream Kompressor - Compress Images and Video</h2>
                        <p>
                            This utility will compress all images and video to the quality level selected <br>
                            <span style="color: red; font-weight: bolder"> WARNING! </span> This utility will require 777 permission inside of the root folder of the
                            web server, and will destroy all .html pages by replacing them, be sure to have a backup!!!!!
                        </p>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Quality Level</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>Fastest</option>
                                <option>Fast</option>
                                <option>Average</option>
                                <option>Best</option>
                                <option>Beautiful</option>
                            </select>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="cream-check-conversion">
                            <label class="form-check-label" for="cream-check-conversion">I've understood!</label>
                        </div>
                        <button type="button" id="sidebarCollapse" class="btn btn-expand mt-5" disabled>
                            <i class="fas fa-align-left"></i>
                            <span class="ml-2"> Convert Assets!!</span>
                        </button>
                        <hr>
                    </div>
                    <!-- Simple SEO tool -->
                    <div class="col-lg-6">
                        <h2 class="mb-4"> SEO tool </h2>
                        <p>
                            Analyze page content to check SEO score, find all the fix needed to have the perfect page!
                        </p>
                        <button type="button" id="sidebarCollapse" class="btn btn-expand mt-5" disabled>
                            <i class="fas fa-align-left"></i>
                            <span class="ml-2"> SEO Check</span>
                        </button>
                        <hr>
                    </div>
                    <!-- Reset to default -->
                    <div class="col-lg-6">
                        <h2 class="mb-4"> Reset to default </h2>
                        <p>
                            Reset all page content to default ones
                        </p>
                        <button type="button" id="sidebarCollapse" class="btn btn-expand mt-5" onclick="ResetDefaults()">
                            <i class="fas fa-align-left"></i>
                            <span class="ml-2"> Reset to default</span>
                        </button>
                        <hr>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php cream_import_scripts(); ?>
</body>

</html>