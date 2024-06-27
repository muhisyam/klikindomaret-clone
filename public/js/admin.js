function findButton(e) {
    const tagName = e.tagName.toLowerCase();
    
    if (tagName == 'button') {
        return e;
    } else {
        return findButton(e.parentElement);
    }
}

function hideAccordContent(e, curr) { 
    e.forEach(listContent => {
        const listId = listContent.id;
        return listId !== curr ? listContent.classList.add('hide') : '';
    });
}

function activateButtonAccord(e, curr) { 
    e.forEach(btnItem => {
        const btnAttribute = btnItem.getAttribute('data-menu-target');
        return btnAttribute !== curr ? btnItem.classList.remove('active') : '';
    });
}

function ariaHiddenToogle(e) { 
    e.forEach(element => {
        const isActive = element.classList.contains('hide');
        return element.setAttribute('aria-hidden', isActive);
    });
}

function ariaExpandedToogle(e) { 
    e.forEach(element => {
        const isActive = element.classList.contains('active');
        return element.setAttribute('aria-expanded', isActive);
    });
}

const listMenuWrapper = document.querySelectorAll('.sidebar .menu-wrapper');

listMenuWrapper.forEach(menu => {
    const accordButtonMenu = menu.querySelector('.accordion-menu-heading button');
    
    if (accordButtonMenu) {
        let dataOpenedMenu = '';
        accordButtonMenu.addEventListener('click', function(e) {
            const listAccordMenu = document.querySelectorAll('.sidebar .accordion-menu-content');
            const listAccordButtonMenu = document.querySelectorAll('.accordion-menu-heading button');
            const accordMenuContent = menu.querySelector('.accordion-menu-content');  
            
            hideAccordContent(listAccordMenu, dataOpenedMenu);
            activateButtonAccord(listAccordButtonMenu, dataOpenedMenu);
            
            accordMenuContent.classList.toggle('hide');
            findButton(e.target).classList.toggle('active');

            dataOpenedMenu = findButton(e.target).getAttribute('data-menu-target');
            
            ariaExpandedToogle(listAccordButtonMenu);
            ariaHiddenToogle(listAccordMenu);
        }); 
    };
});

// MARK: Noftification.
/**
 * Admin float notification constructor.
 * 
 * @param title   - Title notification
 * @param message - Message notification information
*/
class FloatNotification {
    /**
     * @param {string} title
     * @param {string} message
    */
    constructor(title, message) {
        this.title        = title;
        this.message      = message;
        this.greetingBody = document.querySelector('.greeting-body');
        this.username     = '';

        // Set long duration notification time.
        this.timeDuration = 5;
        this.timeLeft     = this.timeDuration - 1;

        this.getCurrentUsername();
        this.runNotification();
    }

    /**
     * Retrieves the current username from the DOM.
    */
    getCurrentUsername() {
        if (! this.checkHasDataUsername()) {
            const username = document.querySelector('.notification-greet span:last-child')?.innerHTML

            document.querySelector('.greeting-body').setAttribute('data-username', username);
        }

        return this.username = document.querySelector('.greeting-body').getAttribute('data-username');
    }

    /**
     * Checks if the 'greeting-body' element has the 'data-username' attribute.
    */
    checkHasDataUsername() {
        return document.querySelector('.greeting-body').hasAttribute('data-username');
    }
    
    /**
     * Executes the notification process by resetting the animation for greeting components,
     * removing all notification components, clearing the interval, creating notification components
     * with a slight delay, and setting an interval to update the countdown.
    */
    runNotification() {
        this.resetGreetingComponentsAnimation();
        this.removeAllNotificationComponents();
        this.clearInterval();

        // Idk why this should use setTimeout. Otherwise, the animation didnt work as well.
        setTimeout(() => this.createNotficationComponents(), 0.1)

        return window.interval = setInterval(() => this.updateCountdown(), 1000)
    }

    /**
     * Clear interval method.
    */
    clearInterval() {
        clearInterval(window.interval)
    }

    /**
     * Remove animation to greet element wrapper.
    */
    resetGreetingComponentsAnimation() {
        this.greetingBody.parentNode.classList.remove('island-notification');
        this.greetingBody.classList.remove('island-fade-in');
    }

    /**
     * Remove notification element when exists.
    */
    removeAllNotificationComponents() {
        document.querySelector('.greeting-body .notification-greet')?.remove();
        document.querySelector('.greeting-body .notification-action')?.remove();
        document.querySelector('.greeting-body ~ .notification-timer')?.remove();
    }

    /**
     * Create notification component element.
    */
    createNotficationComponents()
    {
        const isLongText              = this.message.length > 25 ? ' animation-running' : '';
        const notificationTimerClass  = ['notification-timer', 'absolute', 'left-0', 'bottom-0', 'h-1', 'w-full', 'bg-secondary', 'transition-width', 'ease-linear', 'duration-[1001ms]'];
        const notificationParentClass = ['notification-action', 'flex', 'items-center', 'gap-2'];
        const notificationInner       = `
            <img class="h-5" src="/img/icons/icon-check.webp" alt="Icon"/>
            <div class="flex items-center gap-2 text-sm">
                <div class="capitalize">${this.title}</div>
                <div class="max-w-[175px] font-bold whitespace-nowrap overflow-hidden">
                    <p class="text relative${isLongText}" title="${this.message}">${this.message}</p>
                </div>
            </div>
            <button type="button" class="rounded-md hover:bg-secondary" button-close-notification>
                <img class="hover-filter-primary mx-auto p-1.5 h-6" src="/img/icons/icon-header-close.webp" alt="Icon"/>
            </button>
        `;
          
        const notificationElement = window.createNewElement({
            parentClass: notificationParentClass, 
            innerBody  : notificationInner,
        });

        const timerNotificationBar = window.createNewElement({
            parentClass: notificationTimerClass,
        });

        this.addIslandAnimation();

        this.greetingBody.appendChild(notificationElement);
        this.greetingBody.insertAdjacentElement("afterend", timerNotificationBar);

        this.initCloseNotification();
    }

    /**
     * Add island animation (like apple do) to greet element wrapper.
    */
    addIslandAnimation() {
        this.greetingBody.parentNode.classList.add('island-notification');
        this.greetingBody.classList.add('island-fade-in');
    }

    /**
     * Recreate greeting text element.
    */
    createGreetingTextElement() {
        const hour = new Date().getHours();
        let greeting;

        if (hour >= 5 && hour < 12) {
            greeting = 'Selamat Pagi';
        } else if (hour >= 12 && hour < 15) {
            greeting = 'Selamat Siang';
        } else if (hour >= 15 && hour < 18) {
            greeting = 'Selamat Sore';
        } else {
            greeting = 'Selamat Malam';
        }

        const greetClass = ['notification-greet'];
        const greetInner = `
            <span>${greeting}</span>, 
            <span class="italic font-bold">${this.username}</span>
        `;

        const greetElement =  window.createNewElement({
            parentClass: greetClass,
            innerBody  : greetInner,
        })

        this.addIslandAnimation();
        this.greetingBody.appendChild(greetElement);
    }

    /**
     * Initialize several event when button close notification it clicked.
    */
    initCloseNotification() {
        const buttonClose = document.querySelector('[button-close-notification]');

        buttonClose.addEventListener('click', () => {
            this.clearInterval();
            this.resetGreetingComponentsAnimation();
            this.removeAllNotificationComponents();

            setTimeout(() => this.createGreetingTextElement(), 0.1);
        })
    }

    /**
     * Handle width timer notification.
    */
    updateProgressBar() {
        const timerNotificationBar = document.querySelector('.greeting-body ~ .notification-timer');
        const currentPercentage    = (this.timeLeft / this.timeDuration) * 100;

        if (timerNotificationBar) {
            timerNotificationBar.style.width = currentPercentage + '%';
        }
    }

    /**
     * Handle notification duration time reduction.
    */
    updateCountdown() {
        this.updateProgressBar();
        this.timeLeft--;

        // Until the bar touch the end
        if (this.timeLeft < -1) {
            this.clearInterval();
            this.resetGreetingComponentsAnimation();
            this.removeAllNotificationComponents();

            setTimeout(() => this.createGreetingTextElement(), 0.1);
        }
    }
}

// MARK: Single image uploader.
/**
 * Class for component single image upload fancy template.
*/
class SingleImageUploader {
    /**
     * @param {bool} directToRemoveMethod
    */
    constructor(directToRemoveMethod = false) {
        this.imageWrapper    = document.querySelector('div[data-element="image-uploaded-wrapper"]');
        this.formInputImg    = document.querySelector('#form-input-image');
        this.validImageTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/webp'];

        if (directToRemoveMethod) {
            this.initButtonRemoveSingleImage();
        } else {
            this.imageUploadHandler();
        }
    }

    /**
     * Render element the image uploaded.
    */
    imageUploadHandler() { 
        const fileImage = this.formInputImg.files[0];
        let imageAttributes, imageSize, isInvalidSize, isInvalidType, isInvalid;
        
        if (fileImage) {
            imageSize     = Math.floor(fileImage.size / 1024);
            isInvalidSize = imageSize > 500;
            isInvalidType = ! this.validImageTypes.includes(fileImage.type);
            isInvalid     = isInvalidSize || isInvalidType;

            imageAttributes = {
                isInvalidSize: isInvalidSize,
                isInvalidType: isInvalidType,
                isInvalid:     isInvalid,
                borderColor:   isInvalid ? 'danger' : 'light-gray-100',
                imageUrl:      URL.createObjectURL(fileImage),
                imageName:     fileImage.name,
                imageSize:     imageSize,
            };

            this.imageWrapper.innerHTML = this.imageItemWrapper(imageAttributes);

            isInvalid 
                ? this.imageWrapper.parentNode.prepend(this.invalidFeedback(imageAttributes)) 
                : this.removeIfInvalidIsExist(this.imageWrapper.parentNode);

            this.initButtonRemoveSingleImage();
        } else {
            this.imageWrapper.innerHTML = this.noImageUploaded();
            this.removeIfInvalidIsExist(this.imageWrapper.parentNode);
        }
    }

    /**
     * Template image uploaded.
     * 
     * @param {string} borderColor - Display red border when image has error
     * @param {string} imageUrl
     * @param {string} imageName
     * @param {string} imageSize
    */
    imageItemWrapper({borderColor, imageUrl, imageName, imageSize}) {
        return `
            <div class="rounded-md p-2 border border-${borderColor} flex items-center justify-between">
                <div class="w-11/12 flex items-center gap-2">
                    <img class="rounded-md h-12 shrink-0" src="${imageUrl}" alt="Category Image">
                    <div>
                        <div class="font-bold line-clamp-1 text-ellipsis">${imageName}</div>
                        <div class="text-xs font-light">${imageSize} kB</div>
                    </div>
                </div>
                <button type="button" class="rounded-md px-1.5 h-8 hover:bg-tertiary hover:text-secondary" data-button-image="remove" data-new-image data-original-image-name="${imageName}">
                    <img class="h-4" src="/img/icons/icon-delete.webp" alt="Icon" loading="lazy"/>
                </button>
            </div>
        `
    }

    /**
     * Template when no image uploaded. 
    */
    noImageUploaded() { 
        return `
            <div class="rounded-md p-2 border border-light-gray-100 flex items-center justify-between">
                <div class="w-11/12 flex items-center gap-2.5">
                    <div class="rounded h-12 w-12 grid place-content-center bg-tertiary ">
                        <img class="h-6 jump" alt="Icon" src="/img/icons/icon-upload.webp" loading="lazy">
                    </div>
                    <div class="font-bold line-clamp-1 text-ellipsis">Tidak ada gambar.</div>
                </div>
            </div>
        `
    }
    
    /**
     * Template invalid feedback image form when has error input. 
     * 
     * @param {bool}   isInvalidSize
     * @param {bool}   isInvalidType
     * @param {string} imageSize
    */
    invalidFeedback({isInvalidSize, isInvalidType, imageSize}) {
        const classElement = ['image-invalid-feedback', 'mb-2', 'rounded-md', 'p-2', 'bg-red-100', 'text-red-700', 'text-sm'];
        const messageSize  = isInvalidSize
            ? `<div class="ps-4 flex items-center gap-1 text-xs">
                    <img class="filter-danger h-1.5" src="/img/icons/icon-dot-circle.webp" alt="Icon" loading="lazy"/>
                    <p class="message">Ukuran gambar >${imageSize}kB</p>
                </div>`
            : '';

        const messageType = isInvalidType
            ? `<div class="ps-4 flex items-center gap-1 text-xs">
                    <img class="filter-danger h-1.5" src="/img/icons/icon-dot-circle.webp" alt="Icon" loading="lazy"/>
                    <p class="message">Format gambar tidak sesuai</p>
                </div>`
            : '';

        const innerBody = `
            <ul>
                <li class="mb-1 flex items-center gap-1">
                    <img class="filter-danger h-4" src="/img/icons/icon-warning-error.webp" alt="Icon" loading="lazy"/>
                    <div class="font-bold leading-none">Category Image</div>
                </li>
                ${messageSize}
                ${messageType}
            </ul>
        `;

        return window.createNewElement({
            parentClass: classElement,
            innerBody  : innerBody,
        })
    }
    
    /**
     * Refresh invalid element every new image is uploaded.
     * 
     * @param {any} parentNode
    */
    removeIfInvalidIsExist(parentNode) {
        return parentNode.querySelector('.image-invalid-feedback')?.remove();
    }

    /**
     * Init button remove event listener.
    */
    initButtonRemoveSingleImage() {
        const buttonRemove = document.querySelector('button[data-button-image="remove"]');
        if (! buttonRemove) return;
    
        buttonRemove.removeEventListener('click', this.removeSingleHandler);
        buttonRemove.addEventListener('click', this.removeSingleHandler);
    }
    
    /**
     * Handle the event remove image do.
    */
    removeSingleHandler(event) { 
        const buttonRemove  = event.currentTarget;
        const formInputImg  = document.querySelector('#form-input-image');
        const title         = "Hapus Gambar:"
        const message       = buttonRemove.getAttribute('data-original-image-name');
        const imageName     = buttonRemove.getAttribute('data-image-name');
        const isNewImage    = buttonRemove.hasAttribute('data-new-image');
    
        formInputImg.value = '';
        formInputImg.dispatchEvent(new Event('input', {bubbles: true}));
        
        SingleImageUploader.addInputDeleteImage(isNewImage, imageName);
    
        new SingleImageUploader();
        new FloatNotification(title, message);
    }

    /**
     * Check the element is new upladed image. If true, it will run create new input. In essence, 
     * if the remove button is pressed, the category image name data will be set to null.
     * 
     * @param {bool}   isNewImage - Statement is element has "data-new-image" attribute.
     * @param {string} imageName  - Image name.
    */
    static addInputDeleteImage(isNewImage, imageName) { 
        if (isNewImage) return;
        
        const formInputImg   = document.querySelector('#form-input-image');
        const formInputName  = formInputImg.getAttribute('name');
        let deleteExistImage = document.createElement('input');

        deleteExistImage.type  = 'text';
        deleteExistImage.name  = 'delete_' + formInputName;
        deleteExistImage.value = imageName;
        deleteExistImage.classList.add('hidden');
    
        formInputImg.insertAdjacentElement('afterend', deleteExistImage);
    }
}

// MARK: Multiple image uploader.
/**
 * Class for component single image upload fancy template.
*/
class MultipleImageUploader {
    /**
     * @param {bool} directToRemoveMethod
    */
    constructor(directToRemoveMethod = false) {
        this.imageWrapper     = document.querySelector('div[data-element="image-uploaded-wrapper"]');
        this.formInputImg     = document.querySelector('#form-input-image');
        this.imageFiles       = window.imageFiles;
        this.validImageTypes  = ['image/jpg', 'image/jpeg', 'image/png', 'image/webp'];
        this.innerInvalidBody = '';

        if (directToRemoveMethod) {
            this.initButtonRemoveMultipleImage();
        } else {
            this.imageUploadHandler();
        }
    }

    /**
     * Render element the image uploaded.
    */
    imageUploadHandler() { 
        const currImageFiles = Object.values(this.imageFiles);
        let showImages = '', imageAttributes, imageSize, isInvalidSize, isInvalidType, isInvalid;

        if (this.ensureFileIsNotEmpty()) {
            currImageFiles.forEach((fileImage, id) => {
                imageSize     = Math.floor(fileImage.size / 1024);
                isInvalidSize = imageSize > 500;
                isInvalidType = ! this.validImageTypes.includes(fileImage.type);
                isInvalid     = isInvalidSize || isInvalidType;

                imageAttributes = {
                    index:         id,
                    isInvalidSize: isInvalidSize,
                    isInvalidType: isInvalidType,
                    isInvalid:     isInvalid,
                    borderColor:   isInvalid ? 'danger' : 'light-gray-100',
                    imageUrl:      URL.createObjectURL(fileImage),
                    imageName:     fileImage.name,
                    imageSize:     imageSize,
                };

                showImages += this.imageItemWrapper(imageAttributes);

                this.createInavalidFeedback(currImageFiles, imageAttributes);
            })

            this.imageWrapper.innerHTML = showImages;

            this.initButtonRemoveMultipleImage();
        } else {
            this.imageWrapper.innerHTML = this.noImageUploaded();
            this.removeIfInvalidIsExist(this.imageWrapper.parentNode);
        }
    }

    /**
     * Checks if the imageFiles object is not empty.
    */
    ensureFileIsNotEmpty() {
        return Object.keys(this.imageFiles).length != 0
    }

    /**
     * Removes the invalid feedback element if it exists.
     *
     * This function searches for an element with the class 'image-invalid-feedback'
     * and removes it from the DOM if it is found.
    */
    removeInvalidIfExist() {
        document.querySelector('.image-invalid-feedback')?.remove();
    }

    /**
     * Creates an invalid feedback element if there are invalid image files.
     *
     * @param {Object} currImageFiles  - The current image files object.
     * @param {Object} imageAttributes - The attributes of the image.
    */ 
    createInavalidFeedback(currImageFiles, imageAttributes) {
        if (this.checkIfHasInvalid(currImageFiles)) {
            if (! imageAttributes.isInvalid) return;

            this.removeInvalidIfExist();
            this.innerInvalidBody += this.innerInvalidFeedback(imageAttributes)
            this.imageWrapper.parentNode.prepend(this.invalidFeedback()) 
        } else {
            this.removeInvalidIfExist();
        }
    }

    /**
     * Checks if there are any invalid image files in the given array.
     *
     * @param {Array} currImageFiles
    */
    checkIfHasInvalid(currImageFiles) {
        return currImageFiles.some(file => {
            const imageSize     = Math.floor(file.size / 1024);
            const isInvalidSize = imageSize > 500;
            const isInvalidType = this.validImageTypes.includes(file.type);

            return isInvalidSize || isInvalidType;
        })
    }

    /**
     * Template image uploaded.
     * 
     * @param {string} borderColor - Display red border when image has error
     * @param {string} imageUrl
     * @param {string} imageName
     * @param {string} imageSize
    */
    imageItemWrapper({borderColor, imageUrl, imageName, imageSize}) {
        return `
            <div class="rounded-md p-2 border border-${borderColor} flex items-center justify-between">
                <div class="w-11/12 flex items-center gap-2">
                    <img class="rounded-md h-12 shrink-0" src="${imageUrl}" alt="Category Image">
                    <div>
                        <div class="font-bold line-clamp-1 text-ellipsis">${imageName}</div>
                        <div class="text-xs font-light">${imageSize} kB</div>
                    </div>
                </div>
                <button type="button" class="rounded-md px-1.5 h-8 hover:bg-tertiary hover:text-secondary" data-button-image="remove" data-new-image data-original-image-name="${imageName}">
                    <img class="h-4" src="/img/icons/icon-delete.webp" alt="Icon" loading="lazy"/>
                </button>
            </div>
        `
    }

    /**
     * Template when no image uploaded. 
    */
    noImageUploaded() { 
        return `
            <div class="rounded-md p-2 border border-light-gray-100 flex items-center justify-between">
                <div class="w-11/12 flex items-center gap-2.5">
                    <div class="rounded h-12 w-12 grid place-content-center bg-tertiary ">
                        <img class="h-6 jump" alt="Icon" src="/img/icons/icon-upload.webp" loading="lazy">
                    </div>
                    <div class="font-bold line-clamp-1 text-ellipsis">Tidak ada gambar.</div>
                </div>
            </div>
        `
    }

    /**
     * Template invalid feedback image form when has error input. 
     * 
     * @param {int}    index
     * @param {bool}   isInvalidSize
     * @param {bool}   isInvalidType
     * @param {string} imageSize
    */
    innerInvalidFeedback({index, isInvalidSize, isInvalidType, imageSize}) {
        const currIndex   = ++index;
        const messageSize = isInvalidSize
            ? `<div class="ps-4 flex items-center gap-1 text-xs">
                    <img class="filter-danger h-1.5" src="/img/icons/icon-dot-circle.webp" alt="Icon" loading="lazy"/>
                    <p class="message">Ukuran gambar >${imageSize}kB</p>
                </div>`
            : '';

        const messageType = isInvalidType
            ? `<div class="ps-4 flex items-center gap-1 text-xs">
                    <img class="filter-danger h-1.5" src="/img/icons/icon-dot-circle.webp" alt="Icon" loading="lazy"/>
                    <p class="message">Format gambar tidak sesuai</p>
                </div>`
            : '';

        return `
            <li>
                <div class="${currIndex != 1 ? 'mb-1 ' : ''}flex items-center gap-1">
                    <img class="filter-danger h-4" src="/img/icons/icon-warning-error.webp" alt="Icon" loading="lazy"/>
                    <div class="font-bold leading-none">Product Images ${index}</div>
                </div>
                ${messageSize}
                ${messageType}
            </li>
        `
    }
    
    /**
     * Template invalid feedback image form when has error input. 
    */
    invalidFeedback() {
        const classElement = ['image-invalid-feedback', 'space-y-2', 'rounded-md', 'p-2', 'bg-red-100', 'text-red-700', 'text-sm'];
        const innerBody    = `${this.innerInvalidBody}`

        return window.createNewElement({
            parentTag:   'ul', 
            parentClass: classElement,
            innerBody:   innerBody,
        })
    }
    
    /**
     * Refresh invalid element every new image is uploaded.
     * 
     * @param {any} parentNode
    */
    removeIfInvalidIsExist(parentNode) {
        return parentNode.querySelector('.image-invalid-feedback')?.remove();
    }

    /**
     * Intialize event button remove click listener, to be able to execute several series of events.
    */
    initButtonRemoveMultipleImage() {
        const buttonRemove = document.querySelectorAll('button[data-button-image="remove"]');
        if (! buttonRemove) return;

        buttonRemove.forEach(button => {
            button.removeEventListener('click', this.removeMultipleHandler);
            button.addEventListener('click', this.removeMultipleHandler);
        });
    }

    /**
     * Handle the event remove image do.
    */
    removeMultipleHandler(event) {
        const buttonRemove = event.currentTarget;
        const formInputImg = document.querySelector('#form-input-image');
        const title        = "Hapus Gambar:"
        const message      = buttonRemove.getAttribute('data-original-image-name');
        const imageName    = buttonRemove.getAttribute('data-image-name');
        const isNewImage   = buttonRemove.hasAttribute('data-new-image');
        const imageHandler = new ImageFileHandler();

        if (isNewImage) {
            // message for identity image target
            imageHandler.removeFileFromFilesList(message);

            new MultipleImageUploader();
        } else {
            const listEl = document.querySelectorAll('[data-element="image-uploaded-wrapper"] > div');

            buttonRemove.parentNode.classList.add('hidden');

            // Check is all exists image is hidden
            if ([...listEl].every(element => element.classList.contains('hidden'))) {
                new MultipleImageUploader();
            }

            MultipleImageUploader.addInputDeleteImage(isNewImage, imageName);
        }

        formInputImg.dispatchEvent(new Event('input', {bubbles: true}));

        new FloatNotification(title, message);
    }

    /**
     * Check the element is new upladed image. If true, it will run create new input. In essence, 
     * if the remove button is pressed, the category image name data will be set to null.
     * 
     * @param {bool}   isNewImage - Statement is element has "data-new-image" attribute.
     * @param {string} imageName  - Image name.
    */
    static addInputDeleteImage(isNewImage, imageName) { 
        if (isNewImage) return;
    
        const formInputImg   = document.querySelector('#form-input-image');
        const formInputName  = formInputImg.getAttribute('name');
        let deleteExistImage = document.createElement('input');
        
        deleteExistImage.type  = 'text';
        deleteExistImage.name  = 'delete_' + formInputName;
        deleteExistImage.value = imageName;
        deleteExistImage.classList.add('hidden');
    
        formInputImg.insertAdjacentElement('afterend', deleteExistImage);
    }
}

// MARK: Handle upload image.
/**
 * Class for handle incoming image file.
*/
class ImageFileHandler {
    /**
     * @param {string} uploadType
    */
    constructor(uploadType = 'single') {
        this.uploadType   = uploadType;
        this.formInputImg = document.querySelector('[id*="input-image"]');
        this.dropAreaImg  = document.querySelector('#drop-area-image');
        this.browseImgBtn = document.querySelector('#browse-img');
    }

    /**
     * Adds files to the image list.
     *
     * @param {FileList} files - The list of files to be added.
    */
    addFilesToImageList(files) {
        const dt             = new DataTransfer();
        const currImageFiles = Object.values(window.imageFiles);
        const formImageFiles = Object.values(files);

        // Add exists image to data transfer list
        currImageFiles.forEach(file => dt.items.add(file));

        // Add new input image to data transfer list
        formImageFiles.forEach(file => (!currImageFiles.some(e => e.name === file.name)) && dt.items.add(file));

        // Assign the updated list to Input Files List and imageFiles
        this.formInputImg.files = window.imageFiles = dt.files;
    }

    /**
     * Removes a file from the list of image files.
     *
     * @param {string} imageName - The name of the file to be removed.
    */
    removeFileFromFilesList(imageName) {
        const dt             = new DataTransfer();
        const currImageFiles = Object.values(window.imageFiles);

        // Exclude the selected file. Thus removing it.
        currImageFiles.forEach(file => (file.name !== imageName) && dt.items.add(file));
        
        // Assign the updates list to Input Files List and imageFiles
        this.formInputImg.files = window.imageFiles = dt.files;
        this.checkIsEmptyFiles();
    }

    /**
     * Check if the form input image file is empty.
    */
    checkIsEmptyFiles() {
        if (this.formInputImg.files.length > 0) return;

        this.formInputImg.value = '';
        this.formInputImg.dispatchEvent(new Event('change', {bubbles: true}));
    }

    /**
     * Activing drop zone layer when image in drop zone.
    */
    handleDragOver(el) {
        el.preventDefault();

        this.dropAreaImg.classList.add('dragover');
        this.browseImgBtn.classList.remove('z-20');
    }

    /**
     * Handle when image drop in drop zone.
    */
    handleDrop(el) {
        el.preventDefault();
        this.handleDragLeave();
        return this.handleImageUpload(el);
    }

    /**
     * Deactive drop zone layer when image leave drop zone.
    */
    handleDragLeave() {
        this.dropAreaImg.classList.remove('dragover');
        this.browseImgBtn.classList.add('z-20');
    }

    /**
     * Handles the image upload based on the upload type.
     *
     * @param {Event} el - The event object containing the files to be uploaded.
    */
    handleImageUpload(el) {
        const files = el.dataTransfer ? el.dataTransfer.files : el.target.files;

        switch (this.uploadType) {
            case 'multiple':
                this.addFilesToImageList(files);
                new MultipleImageUploader();
                break;
        
            default:
                this.formInputImg.files = files;
                new SingleImageUploader();
                break;
        }
    }
}

/**
 * MARK: Accordion.
 * 
 * Class for handling accordion element.
*/
class Accordion {
    /**
     * Toggle the accordion state.
     * 
     * @param {Object}      opt                 - Options object
     * @param {boolean}     opt.isHide          - Indicates whether the accordion element target has the 'hide' class
     * @param {string}      opt.hideClass       - Name of 'hide' class
     * @param {HTMLElement} opt.targetEl        - The accordion element target
     * @param {HTMLElement} opt.wrapperEl       - The element that wraps the target element
     * @param {string}      opt.additionalClass - Additional classes want to add to wrapper class
    */
    toogleAccordion({isHide, hideClass = 'hide', targetEl, wrapperEl, additionalClass = 'active'}) { 
        if (isHide) {
            targetEl.classList.remove(hideClass);
            wrapperEl.classList.add(additionalClass);
        } else {
            targetEl.classList.add(hideClass);
            wrapperEl.classList.remove(additionalClass);
        }
    };
}