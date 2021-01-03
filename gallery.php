<!DOCTYPE html>
<?php
include "src/CreamLoader.php";
error_reporting(E_ALL);
ini_set('display_errors', 'on');
cream_loader();

// Name of the folder to be loaded
if (isset($_GET['name'])) {
    $name = $_GET['name'];
}

// ID of the gallery HTML element
$gallery_id = "main_gallery";

$creamConfig = new CreamConfig();
$path = $creamConfig->GetImagePathByName($name);
// Getting paths for all images inside the folder
$paths = [];
foreach (glob($path . "*.{JPG,GIF,JPEG,PNG,jpg,gif,jpeg,png}", GLOB_BRACE) as $image) {
    array_push($paths, $image);
}
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
                <div class="row text-center">

                    <div class="col-md-6 text-center mb-3">
                        <button type="button" class="btn btn-main" id="deleteImages">
                                <i class="fas fa-trash"></i>
                                <span class="ml-2"> Delete images</span>
                        </button>
                    </div>

                    <div class="col-md-6 mb-3">
                        <button type="button" class="btn btn-main" onclick="window.location='./image_upload.php';">
                                <i class="fas fa-arrow-up"></i>
                                <span class="ml-2"> Upload New Image! </span>
                            </button>
                    </div>

                    <div class="col-lg-12">
                        <?php cream_render_gallery($gallery_id); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <?php cream_render_footer(); ?>
    <?php cream_import_scripts(); ?>

    <script>
        window.onload = function() {
            let creamGallery = new CreamGallery('<?php echo json_encode($paths); ?>', "<?php echo $gallery_id; ?>");

            let deleteButton = document.getElementById('deleteImages');
            deleteButton.addEventListener('click', (e) => {
                creamGallery.displayImageDelete();
            });
        }

        
    </script>
</body>

</html>