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

	<title>Cream Manager | Editor </title>

	<?php cream_import_links(); ?>
</head>

<body>
	<div class="wrapper">
		<?php cream_render_sidebar(); ?>

		<!-- Page Content  -->
		<div id="content">
			<!-- Editor Buttons -->
			<div class="editor-buttons">
				<button type="button" onclick="SaveAll();" class="btn btn-expand">
					<i class="fas fa-check"></i>
					<span>Save</span>
				</button>
				<button type="button" class="btn btn-expand">
					<i class="fas fa-times"></i>
					<span>Discard</span>
				</button>
			</div>
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="container-fluid">

					<button type="button" id="sidebarCollapse" class="btn btn-expand">
						<i class="fas fa-align-left"></i>
						<span>Toggle Sidebar</span>
					</button>
					<p class="page-indicator">Editor: <?php echo $pagestr; ?></p>
				</div>
			</nav>
			<!-- Proper editor -->
			<!-- Editor -->
			<div class="col-md-12">
				<div class="text-center">
					<iframe onload="CreamStart()" src="../<?php echo $pagestr; ?>" class="embed-responsive-item editor" id="graphicalEditor"></iframe>
				</div>
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

	<?php cream_import_scripts(); ?>
</body>

</html>