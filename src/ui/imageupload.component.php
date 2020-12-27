<?php

/**
 * Renders the imageupload component
 */
function cream_render_img_upload() {
    include_once("./src/CreamLoader.php");
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');

    $creamConfig = new CreamConfig;
    $creamConfig->FetchConfig("./config.json");
    ob_start();
?>
    <div class="container py-5 text-center">
        <div class="row">
            <div class="col-lg-12">
                <h3> Select where to upload the image </h3>
                <div id="selector">
                    <select name="paths" id="paths" class="btn btn-main">
                        <?php foreach ($creamConfig->GetAllImagePaths() as $imagePath) : ?>
                            <option value="<?php echo $imagePath->path; ?>">
                                <?php echo $imagePath->name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12">
                <div id="drag-drop-area" style="
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    align-content: center;
                    justify-items: center;">
                </div>
            </div>
        </div>
        <script src="https://transloadit.edgly.net/releases/uppy/v1.6.0/uppy.min.js"></script>
        <script>
            let currentPath = null;
            let pathSelector = document.getElementById('paths');
            var uppy = Uppy.Core({
                    logger: Uppy.debugLogger,
                    meta: {
                        username: 'test',
                        path: '../' + currentPath
                    }
                })
                .use(Uppy.Dashboard, {
                    inline: true,
                    target: '#drag-drop-area'
                })
                .use(Uppy.XHRUpload, {
                    endpoint: './api/upload_image.php'
                }) //you can put upload URL here, where you want to upload images
            /*
            uppy.on('complete', (result) => {
                console.log('Upload complete! We’ve uploaded these files:', result.successful)
            })
            */
            uppy.on('upload-success', (file, response) => {
                console.log(response.status); // HTTP status code
                console.log(response.body); // extracted response data
                // do something with file and response
            })
            //currentPath = pathSelector.value;

            pathSelector.addEventListener('change', (e) => {
                currentPath = e.target.value;
                uppy.setMeta({path: '../' + currentPath});
            });
        </script>
    </div>
<?php
    echo ob_get_clean();
}
?>