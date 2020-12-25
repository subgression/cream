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
        target.style.maxHeight = "50vh";
        target.style.padding = "5px";
        target.style.border = "1px dashed var(--dark)";

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
        }
        else {
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