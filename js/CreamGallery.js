/*====================================
CreamGalleryElement: This component will create a gallery
given an array of paths from API Backend
=====================================*/
class CreamGallery {
    creamGalleryElements = [];

    /**
     * Creates the Cream Gallery
     * @param {*} paths: Current paths of the images to be shown
     * @param {string} targetID: The target div
     */
    constructor(paths, targetID) {
        console.log("[CreamGallery] Starting...");
        this.createGalleryElement(JSON.parse(paths), targetID);
    }

    /**
     * Creates gallery element
     * @param {*} paths: Current paths of the images to be shown
     * @param {string} targetID: The target div
     */
    createGalleryElement(paths, targetID) {
        console.log("[CreamGallery] Creating Gallery Main in container " + targetID + "...");
        let target = document.getElementById(targetID);
        target.style.display = "flex";
        target.style.flexWrap = "wrap";
        target.style.justifyContent = "center";
        target.style.alignItems = "center";
        target.style.overflowY = "scroll";
        target.style.maxHeight = "100vh";
        target.style.padding = "5px";
        //target.style.border = "1px dashed var(--dark)";

        // Appending elements
        paths.forEach(path => {
            let galleryElement = new CreamGalleryElement();
            target.appendChild(galleryElement.createElement(path));
            this.creamGalleryElements.push(galleryElement);
        });
    }

    /**
     * Hide/Displays image delete button for each CreamGalleryElement in the array
     */
    displayImageDelete() {
        console.log(this.creamGalleryElements);
        for (let i = 0; i < this.creamGalleryElements.length; i++) {
            this.creamGalleryElements[i].showDeleteButtons();
        }
    }
}

/*====================================
CreamGallerySelector: Display the gallery selector
It allows user to choose wich image folder they want
as long as they're defined in the config.json
=====================================*/
class CreamGallerySelector {
    // Main gallery selector container
    gallerySelector = null;
    // Gallery editor container
    galleryEditorContainer = null;
    // Gallery selector gallery container
    gallerySelectorGalleryContainer = null;
    // Current target img src
    currentImageSrc = null;
    // The image that will change
    galleryTargetImageElement = null;
    // Target image 
    targetImage = null;
    
    /**
     * Entry point
     */
    constructor(gallerySelectorID, gallerySelectorGalleryContainerID, galleryEditorContainerID, targetImage) {
        this.gallerySelector = document.getElementById(gallerySelectorID);
        this.gallerySelector.style.width = "100%";
        this.gallerySelector.style.height = "100%";
        this.gallerySelector.style.position = "fixed";
        this.gallerySelector.style.zIndex = "99";
        this.gallerySelector.style.top = "0px";
        this.gallerySelector.style.left = "0px";
        this.gallerySelector.style.backgroundColor = "var(--light)";
        this.gallerySelector.style.visibility = "visible";

        this.targetImage = targetImage;

        this.createGalleryEditor(galleryEditorContainerID, gallerySelectorGalleryContainerID, targetImage.src);
        this.createGalleryContainer(gallerySelectorGalleryContainerID, null);
    }

    /**
     * Creates the gallery editor, allowing user to change src of the selected image
     * @param {*} galleryEditorContainerID The gallery editor container ID
     * @param {*} gallerySelectorGalleryContainerID Gallery container ID, that will change if user changes path
     * @param {*} currentImageSrc Current image src, to be displayed
     */
    createGalleryEditor(galleryEditorContainerID, gallerySelectorGalleryContainerID, currentImageSrc) {
        this.galleryEditorContainer = document.getElementById(galleryEditorContainerID);
        this.galleryEditorContainer.style.padding = "25px";
        this.galleryEditorContainer.style.backgroundColor = "var(--dark)";
        this.galleryEditorContainer.style.color = "var(--light)";
        this.galleryEditorContainer.style.height = "100vh";

        let galleryEditorHeader = document.createElement('h2');
        galleryEditorHeader.innerHTML = "Change Image";

        this.galleryTargetImageElement = document.createElement('img');
        this.galleryTargetImageElement.classList.add('img');
        this.galleryTargetImageElement.classList.add('img-fluid');
        this.galleryTargetImageElement.classList.add('rounded');
        this.galleryTargetImageElement.style.marginTop = "25px";
        this.galleryTargetImageElement.style.marginBottom = "25px";
        this.galleryTargetImageElement.src = currentImageSrc;

        let galleryEditorSelectorHelper = document.createElement('p');
        galleryEditorSelectorHelper.innerHTML = "Choose Directory";

        this.galleryEditorContainer.appendChild(galleryEditorHeader);
        this.galleryEditorContainer.appendChild(this.galleryTargetImageElement);
        this.galleryEditorContainer.appendChild(galleryEditorSelectorHelper);
        this.createPathSelector(gallerySelectorGalleryContainerID);

        // Creating Change/Close container and buttons
        let galleryChangeCloseContainer = document.createElement('div');
        galleryChangeCloseContainer.style.position = "absolute";
        galleryChangeCloseContainer.style.bottom = "0px";
        galleryChangeCloseContainer.style.display = "flex";
        galleryChangeCloseContainer.style.flexDirection = "row";
        galleryChangeCloseContainer.style.left = "0px";
        galleryChangeCloseContainer.style.width = "100%";
        galleryChangeCloseContainer.style.justifyContent = "center";
        galleryChangeCloseContainer.style.paddingBottom = "15px";

        let galleryCloseButton = document.createElement('button');
        galleryCloseButton.classList.add("btn");
        galleryCloseButton.classList.add("btn-main");
        galleryCloseButton.style.marginLeft = "5px";
        galleryCloseButton.style.marginRight = "5px";
        galleryCloseButton.innerHTML = "Close";
        galleryCloseButton.addEventListener('click', (e) => {
            this.closeGallerySelector();
        });


        let galleryChangeButton = document.createElement('button');
        galleryChangeButton.classList.add("btn");
        galleryChangeButton.classList.add("btn-danger");
        galleryChangeButton.style.marginLeft = "5px";
        galleryChangeButton.style.marginRight = "5px";
        galleryChangeButton.innerHTML = "Change";
        galleryChangeButton.addEventListener('click', (e) => {
            this.changeTargetImgSrc(this.galleryTargetImageElement.src);
        });
        
        galleryChangeCloseContainer.appendChild(galleryCloseButton);
        galleryChangeCloseContainer.appendChild(galleryChangeButton);
        this.galleryEditorContainer.appendChild(galleryChangeCloseContainer);
    }

    /**
     * Closes the gallery
     */
    closeGallerySelector() {
        this.gallerySelector.style.visibility = "hidden";
        this.galleryEditorContainer.innerHTML = '';
    }

    /**
     * Change selected image src and than closes the gallery
     * @param {*} src 
     */
    changeTargetImgSrc(src) {
        this.targetImage.src = src;
        this.closeGallerySelector(); 
    }

    /**
     * Creates the gallery container
     * @param {string} gallerySelectorGalleryContainerID The gallery container ID
     * @param {*} targetPath Path JSON file containing the name and path of all cream paths
     */
    createGalleryContainer(gallerySelectorGalleryContainerID, targetPath = null) {
        let container = document.getElementById(gallerySelectorGalleryContainerID);
        container.style.padding = "25px";
        let creamGallery = null;
        container.innerHTML = '';
        // If no target path has been used, use the first provided by API
        if (targetPath == null) {
            $.post("./api/get_image_paths.php", {}, (paths) => {
                paths = JSON.parse(paths);
                $.get("./api/get_images.php", {name: paths[0].name}, (images) => {
                    creamGallery = new CreamGallery(images, gallerySelectorGalleryContainerID);

                    // Additional styling for editor
                    creamGallery.creamGalleryElements.forEach((galleryElement) => {
                        galleryElement.image.style.maxWidth = "150px";
                        galleryElement.image.style.maxHeight = "150px";
                        galleryElement.image.addEventListener('click', (e) => {
                            this.galleryTargetImageElement.src = galleryElement.image.src;
                        })
                    })
                    let creamGalleryElement = document.getElementById(gallerySelectorGalleryContainerID);
                    creamGalleryElement.style.maxHeight = "90vh";
                });
            });
        }
        // Else use the one provided as a paremeter
        else {
            console.log(targetPath);
            $.get("./api/get_images.php", {name: targetPath}, (images) => {
                creamGallery = new CreamGallery(images, gallerySelectorGalleryContainerID);

                // Additional styling for editor
                creamGallery.creamGalleryElements.forEach((galleryElement) => {
                    galleryElement.image.style.maxWidth = "150px";
                    galleryElement.image.style.maxHeight = "150px";
                    galleryElement.image.addEventListener('click', (e) => {
                        this.galleryTargetImageElement.src = galleryElement.image.src;
                    })
                })
                let creamGalleryElement = document.getElementById(gallerySelectorGalleryContainerID);
                creamGalleryElement.style.maxHeight = "90vh";
            });
        }
    }

    /**
     * Gets all paths via Cream API and creates the selector
     */
    createPathSelector(gallerySelectorGalleryContainerID) {
        $.post("./api/get_image_paths.php", {}, (data) => {
            this.pathSelector = document.createElement('select');
            this.pathSelector.classList.add("btn-main");
            let i = 0;
            data = JSON.parse(data);
            data.forEach((path) => {
                let pathSelectorOption = document.createElement('option');
                pathSelectorOption.setAttribute('value', path.name);
                if (i == 0) pathSelectorOption.selected = true;
                pathSelectorOption.innerHTML = path.name;
                this.pathSelector.appendChild(pathSelectorOption);
                i++;
            });
            // adding event listener to change gallery location
            this.pathSelector.addEventListener('change', (e) => {
                console.log("[CreamImageSelector] Loading gallery for name " + e.target.value);
                this.createGalleryContainer(gallerySelectorGalleryContainerID, e.target.value);
            });

            this.galleryEditorContainer.appendChild(this.pathSelector);
        });
    }
}

/*====================================
CreamGalleryElement: Class that holds all the logic
for each gallery element (AKA Image)
=====================================*/
class CreamGalleryElement {
    // Image instance
    image = null;
    // Instance of image delete button
    imageDelete = null;
    // Image delete buttons shown?
    imageDeleteShown = false;

    constructor() {}

    /**
     * Creates an image element, with delete button and a proper wrapper
     * @param {*} path 
     */
    createElement(path) {
        let wrapper = document.createElement('div');
        //wrapper.style.gridTemplateColumns = "repeat(4, 1fr);";
        //wrapper.style.gridTemplateRows = "repeat(3, 150px)";

        let image = document.createElement('img');
        image.src = path;
        image.classList.add("img-fluid");
        image.classList.add('rounded');
        image.style.margin = "25px";
        image.style.maxHeight = "250px";
        image.style.maxWidth = "250px";
        image.style.objectFit = "cover";
        image.style.verticalAlign = "bottom";
        this.image = image;

        let imageDelete = document.createElement('div');
        imageDelete.style.margin = "25px";
        imageDelete.style.width = "40px";
        imageDelete.style.height = "40px";
        imageDelete.style.position = "relative";
        imageDelete.style.top = "70px";
        imageDelete.style.right = "20px";
        imageDelete.style.display = "flex";
        imageDelete.style.alignItems = "center";
        imageDelete.style.justifyContent = "center";
        imageDelete.style.backgroundColor = "var(--light)";
        imageDelete.style.borderRadius = "5px";
        imageDelete.style.visibility = "hidden";
        imageDelete.style.zIndex = "2";
        // Adding image delete listener
        imageDelete.addEventListener('click', (e) => {
            this.displayWarningModal(path, "delete-modal");
        });
        let deleteIcon = document.createElement('i');
        deleteIcon.classList.add("fas");
        deleteIcon.classList.add("fa-times");

        imageDelete.appendChild(deleteIcon);
        // Pushing the imageDelete button
        // to be served when needed
        this.imageDelete = imageDelete;


        wrapper.appendChild(imageDelete);
        wrapper.appendChild(image);
        return wrapper;
    }

    /**
     * Show/Hide all the instances of image delete buttons
     * because they suck
     * @todo restyle them
     */
    showDeleteButtons() {
        if (!this.imageDeleteShown) {
            this.imageDelete.style.visibility = "visible";
            this.image.classList.add('wobble');
            this.imageDeleteShown = true;
        } else {
            this.imageDelete.style.visibility = "hidden";
            this.image.classList.remove('wobble');
            this.imageDeleteShown = false;
        }
    }

    /**
     * Display the modal showing the warning
     * @param {*} path 
     * @param {*} id 
     */
    displayWarningModal(path, id) {
        // the modal does not exists yet, create that first
        if (document.getElementById(id) == null) {
            this.createWarningModal(path, id);
        }
        $('#' + id).modal('toggle');
    }

    /**
     * Creates the warning modal and append it
     * to the end of the DOM
     * @param {*} path 
     * @param {*} id 
     */
    createWarningModal(path, id) {
        let modal = document.createElement('div');
        modal.classList.add("modal");
        modal.classList.add("fade");
        modal.setAttribute('id', id);
        modal.setAttribute('role', 'dialog');
        modal.setAttribute('aria-labelledby', 'deleteModalLabel')
        modal.setAttribute('tabindex', '-1');

        let modalDialog = document.createElement('div');
        modalDialog.classList.add('modal-dialog');
        modalDialog.classList.add('modal-dialog-centered');
        modalDialog.setAttribute('role', 'document');

        let modalContent = document.createElement('div');
        modalContent.classList.add('modal-content');
        modalContent.style.backgroundColor = 'var(--light)';
        modalContent.style.color = 'var(--dark)';

        /*-----------------------------------
        Creating Modal Header
        -------------------------------------*/
        let modalHeader = document.createElement('div');
        modalHeader.classList.add('modal-haeader');

        let modalHeaderTitle = document.createElement('h5');
        modalHeaderTitle.classList.add('modal-title');
        modalHeaderTitle.setAttribute('id', 'deleteModalLabel');

        let modalHeaderButton = document.createElement('button');
        modalHeaderButton.setAttribute('type', 'button');
        modalHeaderButton.setAttribute('data-dismiss', 'modal');
        modalHeaderButton.setAttribute('aria-label', 'Close');
        modalHeaderButton.classList.add('close');

        let modalHeaderButtonSpan = document.createElement('span');
        modalHeaderButtonSpan.setAttribute('aria-hidden', 'true');
        modalHeaderButtonSpan.innerHTML = '&times;';
        modalHeaderButtonSpan.style.padding = "10px";

        modalHeaderButton.appendChild(modalHeaderButtonSpan);
        modalHeader.appendChild(modalHeaderTitle);
        modalHeader.appendChild(modalHeaderButton);

        /*-----------------------------------
        Creating Modal Body
        -------------------------------------*/
        let modalBody = document.createElement('div');
        modalBody.classList.add('modal-body');

        let modalBodyTitle = document.createElement('h3');
        modalBodyTitle.style.color = "rgba(200, 20, 20, 1)";
        modalBodyTitle.innerHTML = "Warning!<br>";

        let modalBodyText = document.createElement('p');
        modalBodyText.innerHTML = "This action will delete the image permanently!! <br> You need to reupload it via Image Upload!";

        modalBody.appendChild(modalBodyTitle);
        modalBody.appendChild(modalBodyText);

        /*-----------------------------------
        Creating Modal Footer
        -------------------------------------*/
        let modalFooter = document.createElement('div');
        modalFooter.classList.add('modal-footer');
        modalFooter.style.borderTop = "1px solid var(--dark)";

        let modalCancelButton = document.createElement('button');
        modalCancelButton.classList.add('btn');
        modalCancelButton.classList.add('btn-main');
        modalCancelButton.setAttribute('type', 'button');
        modalCancelButton.setAttribute('data-dismiss', 'modal');
        modalCancelButton.innerHTML = "Cancel";

        let modalDeleteButton = document.createElement('button');
        modalDeleteButton.classList.add('btn');
        modalDeleteButton.classList.add('btn-danger');
        modalDeleteButton.setAttribute('type', 'button');
        modalDeleteButton.innerHTML = 'Delete';

        modalFooter.appendChild(modalCancelButton);
        modalFooter.appendChild(modalDeleteButton);

        /*-----------------------------------
        Adding event listener to cancel the image
        -------------------------------------*/
        modalDeleteButton.addEventListener('click', (e) => {
            this.deleteImage(path);
        });

        /*-----------------------------------
        Appending everything to the modal
        -------------------------------------*/
        modalContent.appendChild(modalHeader);
        modalContent.appendChild(modalBody);
        modalContent.appendChild(modalFooter);
        modalDialog.appendChild(modalContent);
        modal.appendChild(modalDialog);
        document.body.appendChild(modal);
    }

    /**
     * Calls Cream API to delete the image
     * @param {stirng} path 
     */
    deleteImage(path) {
        console.log("Deleting image: " + path);
        $.post("./api/delete_image.php", {
            path: path,
        }, function (data) {
            console.log(data);
            let res = JSON.parse(data);
            if (res.code == 200) window.location = window.location;
            else console.error(res);
        });
    }
}