<!DOCTYPE html>
<?php
    include "src/CreamLoader.php";
    cream_loader();
?>
<?php  
    // Obtaining the topping from query string
    $t = null;
    if (isset($_GET['t'])) {
        $t = $_GET['t'];
    }

    $topping = new CreamTopping($t);
?>
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

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        Topping editor
                        <!-- Editor Buttons -->
                        <div class="editor-buttons">
                            <button type="button" onclick="SaveAll()" class="btn btn-expand">
                                <i class="fas fa-check"></i>
                                <span>Save</span>
                            </button>
                            <button type="button" onclick="AddInnerTopping()" class="btn btn-expand">
                                <i class="fas fa-plus"></i>
                                <span>Add Topping </span>
                            </button>
                            <button type="button" class="btn btn-expand">
                                <i class="fas fa-times"></i>
                                <span>Discard</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <iframe onload="CreamToppingStart('<?php echo $_GET['t']?>')" src="./_host.php?t=<?php echo $_GET['t']?>" class="embed-responsive-item editor" id="graphicalEditor"></iframe>
                    </div>
                </div>     
            </div>

            <!-- Custom text and image editor container -->
            <!-- Gallery -->
            <div id="gallerySelector" style="visibility: hidden;">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Currently selected image -->
                        <div class="col-lg-4 text-center" id="galleryEditorContainer">

                        </div>
                        <!-- Gallery Container -->
                        <div class="col-lg-8" id="gallerySelectorGalleryContainer">

                        </div>
                    </div>
                </div>
            </div>
            <!-- Save/Close buttons -->
            <div id="editButtons" style="position: fixed; opacity:0.0;">
                <button type="btn btn-expand" name="button"><i class="fas fa-check"></i></button>
                <button type="btn btn-expand" name="button"><i class="fas fa-times"></i></button>
            </div>
        </div>
    </div>

    <?php cream_render_footer(); ?>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- Editor js -->
    <script src="js/CreamTopping.js"></script>
    <script src="js/CreamGallery.js"></script>
    <script src="js/CreamWizard.js"></script> 
    <!-- Sidebar opener -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>
