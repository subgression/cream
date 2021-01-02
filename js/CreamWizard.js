class CreamWizard {
    // The wizard container
    wizardContainer = null;

    /**
     * Creates the cream wizard
     * @param {string} id The ID of the Wizard Container 
     */
    constructor(id) {
        this.wizardContainer = document.getElementById(id);


    }

    /**
     * Creates defauolt cream logo element
     */
    createCreamLogo() {
        let creamLogo = document.createElement('img');
        creamLogo.src = "./img/cream_icon.png";
        creamLogo.classList.add('card-img-top');

        return creamLogo;
    }

    /**
     * Creates default next button element
     */
    createNextButton() {
        let creamButton = document.createElement('a');
        creamButton.classList.add('btn');
        creamButton.classList.add('btn-main');
        creamButton.innerHTML = "Next";

        return creamButton;
    }

    /**
     * Create Wizard heading element
     * @param {*} headingText what to show in the heading
     */
    createHeading(headingText) {
        let heading = document.createElement('h5');
        heading.classList.add('card-heading');
        heading.innerHTML = headingText;

        return heading;
    }

    /**
     * Creates Wizard text element
     * @param {*} text 
     */
    createText(text) {
        let textElement = document.createElement('p');
        textElement.classList.add('card-text');
        textElement.innerHTML = text;

        return textElement;
    }

    /**
     * Creates the welcome page inside the wizard container
     */
    createWelcomePage() {
        this.wizardContainer.innerHTML = '';

        let creamLogo = this.createCreamLogo();
        let creamHeading = this.createHeading("Welcome to Cream CMS!");
        let creamText = this.createText("This Wizard will help you configure Cream CMS, it's settings and what you can do with it!");
        let creamNextButton = this.createNextButton();

        creamNextButton.addEventListener('click', (e) => {
            this.createDatabaseConfiguration();
        });

        this.wizardContainer.appendChild(creamLogo);
        this.wizardContainer.appendChild(creamHeading);
        this.wizardContainer.appendChild(creamText);
        this.wizardContainer.appendChild(creamNextButton);
    }

    /**
     * Creates database configuration wizard entry
     */
    createDatabaseConfiguration() {
        this.wizardContainer.innerHTML = '';
        let creamLogo = this.createCreamLogo();
        let creamHeading = this.createHeading('Database Configuration');
        let creamText = this.createText("Let's start by configuring the Cream Database!");
        let databaseConfigurationForm = this.createDatabaseConfigurationForm();
        let creamNextButton = this.createNextButton();

        let errorUI = document.createElement('p');
        errorUI.classList.add('mt-3');
        errorUI.style.color = "red";
        errorUI.style.fontWeight = "bold";
        errorUI.style.visibility = "hidden";

        creamNextButton.addEventListener('click', (e) => {
            let dbHost = document.getElementById('database-host');
            let dbName = document.getElementById('database-name');
            let dbUser = document.getElementById('database-user');
            let dbPass = document.getElementById('database-pass');

            if (dbHost.value == "" || dbHost.value == null || dbHost.value == undefined) {
                errorUI.style.visibility = "visible";
                errorUI.innerHTML = "A DB Host must be set!";
                return;
            }
            if (dbName.value == "" || dbName.value == null || dbName.value == undefined) {
                errorUI.style.visibility = "visible";
                errorUI.innerHTML = "A DB Name must be set!";
                return;
            }
            if (dbUser.value == "" || dbUser.value == null || dbUser.value == undefined) {
                errorUI.style.visibility = "visible";
                errorUI.innerHTML = "A DB User must be set!";
                return;
            }
            if (dbPass.value == "" || dbPass.value == null || dbPass.value == undefined) {
                errorUI.style.visibility = "visible";
                errorUI.innerHTML = "A DB Password must be set!";
                return;
            }
            console.log("Sending data to Wizard REST");

            $.post("./api/wizard/create_db.php", {dbHost: dbHost.value, dbName: dbName.value, dbUser: dbUser.value, dbPass: dbPass.value}, (data) => {
                console.log(data);
                data = JSON.parse(data);
                // Display errors, if ANY
                if (data.code != 200) {
                    errorUI.style.visibility = "visible";
                    errorUI.innerHTML = data.message;
                }
                else {
                    this.createAdminUser();
                }
            });
        });

        this.wizardContainer.appendChild(creamLogo);
        this.wizardContainer.appendChild(creamHeading);
        this.wizardContainer.appendChild(creamText);
        this.wizardContainer.appendChild(databaseConfigurationForm);
        this.wizardContainer.appendChild(creamNextButton);
        this.wizardContainer.appendChild(errorUI);
    }

    createAdminUser() {
        this.wizardContainer.innerHTML = '';
        let creamLogo = this.createCreamLogo();
        let creamHeading = this.createHeading('Administrator User Configuration');
        let creamText = this.createText("Now let's configure the Admin account!");
        let adminUserForm = this.createAdminUserForm();
        let creamNextButton = this.createNextButton();
        let errorUI = document.createElement('p');
        errorUI.classList.add('mt-3');
        errorUI.style.color = "red";
        errorUI.style.fontWeight = "bold";
        errorUI.style.visibility = "hidden";

        creamNextButton.addEventListener('click', (e) => {
            let adminUser = document.getElementById('admin-user');
            let adminPass = document.getElementById('admin-pass');
            let adminRePass = document.getElementById('admin-re-pass');

            if (adminUser.value == "" || adminUser.value == null || adminUser.value == undefined) {
                errorUI.style.visibility = "visible";
                errorUI.innerHTML = "Please enter admin user!";
                return;
            }
            if (adminPass.value == "" || adminPass.value == null || adminPass.value == undefined) {
                errorUI.style.visibility = "visible";
                errorUI.innerHTML = "Please enter password!";
                return;
            }
            if (adminRePass.value == "" || adminRePass.value == null || adminRePass.value == undefined) {
                errorUI.style.visibility = "visible";
                errorUI.innerHTML = "Please re enter password!";
                return;
            }

            $.post("./api/wizard/create_admin_user.php", {user: adminUser.value, password: adminPass.value}, (data) => {
                console.log(data);
                data = JSON.parse(data);
                if (data.code != 200) {
                    errorUI.style.visibility = "visible";
                    errorUI.innerHTML = data.message;
                }
                else {
                    //this.createAdminUser();
                }
            });
        });

        this.wizardContainer.appendChild(creamLogo);
        this.wizardContainer.appendChild(creamHeading);
        this.wizardContainer.appendChild(creamText);
        this.wizardContainer.appendChild(adminUserForm);
        this.wizardContainer.appendChild(creamNextButton);
        this.wizardContainer.appendChild(errorUI);
    }

    /*----------------------------------------
     * FORMS
     *----------------------------------------*/
    /**
     * Creates the database configuration form
     */
    createDatabaseConfigurationForm() {
        let configurationForm = document.createElement('form');
        configurationForm.classList.add('mb-3');
        configurationForm.classList.add('mt-3');

        // Database host
        let databaseHostFormGroup = document.createElement('div'); 
        databaseHostFormGroup.classList.add('form-group');
        let databaseHostLabel = document.createElement('label');
        databaseHostLabel.setAttribute('for', 'database-host');
        let databaseHostInput = document.createElement('input');
        databaseHostInput.classList.add('form-control');
        databaseHostInput.setAttribute('type', 'text');
        databaseHostInput.setAttribute('id', 'database-host');
        databaseHostInput.setAttribute('placeholder', 'Database Host');
        databaseHostFormGroup.appendChild(databaseHostLabel);
        databaseHostFormGroup.appendChild(databaseHostInput);

        // Database name
        let databaseNameFormGroup = document.createElement('div'); 
        databaseNameFormGroup.classList.add('form-group');
        let databaseNameLabel = document.createElement('label');
        databaseNameLabel.setAttribute('for', 'database-name');
        let databaseNameInput = document.createElement('input');
        databaseNameInput.classList.add('form-control');
        databaseNameInput.setAttribute('type', 'text');
        databaseNameInput.setAttribute('id', 'database-name');
        databaseNameInput.setAttribute('placeholder', 'Database Name');
        databaseNameFormGroup.appendChild(databaseNameLabel);
        databaseNameFormGroup.appendChild(databaseNameInput);

        // Database user
        let databaseUserFormGroup = document.createElement('div'); 
        databaseUserFormGroup.classList.add('form-group');
        let databaseUserLabel = document.createElement('label');
        databaseUserLabel.setAttribute('for', 'database-user');
        let databaseUserInput = document.createElement('input');
        databaseUserInput.classList.add('form-control');
        databaseUserInput.setAttribute('type', 'text');
        databaseUserInput.setAttribute('id', 'database-user');
        databaseUserInput.setAttribute('placeholder', 'Database User');
        databaseUserFormGroup.appendChild(databaseUserLabel);
        databaseUserFormGroup.appendChild(databaseUserInput);

        // Database password
        let databasePassFormGroup = document.createElement('div'); 
        databasePassFormGroup.classList.add('form-group');
        let databasePassLabel = document.createElement('label');
        databasePassLabel.setAttribute('for', 'database-pass');
        let databasePassInput = document.createElement('input');
        databasePassInput.classList.add('form-control');
        databasePassInput.setAttribute('type', 'password');
        databasePassInput.setAttribute('id', 'database-pass');
        databasePassInput.setAttribute('placeholder', 'Database Password');
        databasePassFormGroup.appendChild(databasePassLabel);
        databasePassFormGroup.appendChild(databasePassInput);

        configurationForm.appendChild(databaseHostFormGroup);
        configurationForm.appendChild(databaseNameFormGroup);
        configurationForm.appendChild(databaseUserFormGroup);
        configurationForm.appendChild(databasePassFormGroup);
        return configurationForm;
    }

    /**
     * Creates the admin user form
     */
    createAdminUserForm() {
        let configurationForm = document.createElement('form');
        configurationForm.classList.add('mb-3');
        configurationForm.classList.add('mt-3');

        // Admin user
        let userFormGroup = document.createElement('div'); 
        userFormGroup.classList.add('form-group');
        let userLabel = document.createElement('label');
        userLabel.setAttribute('for', 'admin-user');
        let userInput = document.createElement('input');
        userInput.classList.add('form-control');
        userInput.setAttribute('type', 'text');
        userInput.setAttribute('id', 'admin-user');
        userInput.setAttribute('placeholder', 'User');
        userFormGroup.appendChild(userLabel);
        userFormGroup.appendChild(userInput);

        // Admin password
        let passFormGroup = document.createElement('div'); 
        passFormGroup.classList.add('form-group');
        let passLabel = document.createElement('label');
        passLabel.setAttribute('for', 'admin-pass');
        let passInput = document.createElement('input');
        passInput.classList.add('form-control');
        passInput.setAttribute('type', 'password');
        passInput.setAttribute('id', 'admin-pass');
        passInput.setAttribute('placeholder', 'Password');
        passFormGroup.appendChild(passLabel);
        passFormGroup.appendChild(passInput);

        // Admin re-enter password
        let passReFormGroup = document.createElement('div'); 
        passReFormGroup.classList.add('form-group');
        let passReLabel = document.createElement('label');
        passReLabel.setAttribute('for', 'admin-re-pass');
        let passReInput = document.createElement('input');
        passReInput.classList.add('form-control');
        passReInput.setAttribute('type', 'password');
        passReInput.setAttribute('id', 'admin-re-pass');
        passReInput.setAttribute('placeholder', 'Re Enter Password');
        passReFormGroup.appendChild(passReLabel);
        passReFormGroup.appendChild(passReInput);

        configurationForm.appendChild(userFormGroup);
        configurationForm.appendChild(passFormGroup);
        configurationForm.appendChild(passReFormGroup);
        return configurationForm;
    }
}