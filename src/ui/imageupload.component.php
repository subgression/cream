<?php

/**
 * Renders the imageupload component
 */
function cream_render_img_upload() {
    ob_start();
?>
    <div class="container py-5 text-center" style="
    display: flex;
    justify-content: center;
    align-items: center;
    align-content: center;
    justify-items: center;
">
        <div id="drag-drop-area"></div>
        <script src="https://transloadit.edgly.net/releases/uppy/v1.6.0/uppy.min.js"></script>
        <script>
            var uppy = Uppy.Core({
                logger: Uppy.debugLogger,
                meta: {
                    username: 'test',
                    path: '../../img/test/'
                }
            })
            .use(Uppy.Dashboard, {
            inline: true,
            target: '#drag-drop-area'
            })
            .use(Uppy.XHRUpload, {endpoint: './api/upload_image.php'}) //you can put upload URL here, where you want to upload images
        /*
        uppy.on('complete', (result) => {
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        })
        */
            uppy.on('upload-success', (file, response) => {
                console.log(response.status); // HTTP status code
                console.log(response.body);   // extracted response data
                // do something with file and response
            })
        </script>
    </div>
<?php
    echo ob_get_clean();
}
?>