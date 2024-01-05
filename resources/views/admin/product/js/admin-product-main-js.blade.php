<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Jquery just for convert purpose(✌ ͡• ₃ ͡•)✌
        $('#form-select-category-parent').select2({
            width: '100%',
            placeholder: 'Pilih kategori induk...',
        });

        $('#form-select-category-children').select2({
            width: '100%',
            placeholder: 'Pilih kategori...',
        });

        $('#form-select-supplier').select2({
            width: '100%',
            placeholder: 'Pilih toko...',
        });

        $('#form-select-product-status').select2({
            width: '100%',
            placeholder: 'Pilih status...',
        });
        // Thanks for the tolerance(👍 ͡• ₃ ͡•)👍
        
        // Change border color if invalid validation 
        const errorSelect = document.querySelectorAll('select[id^=form-select].is-invalid');

        errorSelect.forEach(el => {
            const s2Target = el.nextSibling;
            const s2Wrapper = s2Target.querySelector('.select2-selection');

            s2Wrapper.style.borderColor = '#dc2626';
        });
    });

//  ==========================================================
//       Uploader class for multiple upload produk images
//  ========================================================== 
    class ImageUploader {
        constructor() {
            this.imageUploadHandler();
        };

        imageUploadHandler() {
            if (imageFiles.length === 0) {
                return uploadedImgWrapper.innerHTML = this.noImageUploaded();
            }

            let showImage, imageAttributes, imageSize;
            const currImageList = Object.values(imageFiles);
            
            currImageList.forEach((element, index) => {
                imageSize = Math.floor(element.size / 1024);

                imageAttributes = {
                    index: index,
                    isInvalid: imageSize > 500 ? ' is-invalid' : '',
                    imageUrl: URL.createObjectURL(element),
                    imageName: element.name,
                    imageSize: imageSize,
                };

                showImage += this.imageItemWrapper(imageAttributes);
            });

            uploadedImgWrapper.innerHTML = showImage;
            initTooltips();
        };

        imageItemWrapper ({isInvalid, imageUrl, imageName, imageSize, index}) {
            return `<div class="item-image-uploaded${isInvalid} relative">
                        <div class="image-item-wrapper flex items-center justify-between border border-light-grey rounded p-2">
                            <div class="image-info-wrapper w-11/12 flex items-center">
                                <figure class="media shrink-0 me-2">
                                    <img class="h-12" src="${imageUrl}" alt="Product Image">
                                </figure>
                                <div class="info">
                                    <p class="text font-bold line-clamp-1 text-ellipsis" data-tooltip-target="image-${index}-tooltip" data-tooltip-placement="bottom">${imageName}</p>
                                    <p class="size text-xs font-light">${imageSize} KB</p>
                                </div>
                            </div>
                            <div class="action">
                                <button type="button" class="icon h-8 text-2xl rounded px-1 hover:bg-tertiary hover:text-secondary" onclick="removeImage(${index})" aria-label="Delete data image" data-image-name="${imageName}">
                                    <i class="ri-delete-bin-6-line"></i>
                                </button>
                            </div>
                        </div>
                        ${isInvalid ? this.invalidFeedback() : ''}
                        <div id="image-${index}-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-md shadow-sm opacity-0 tooltip">
                            ${imageName}
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </div>`;
        };

        invalidFeedback() {
            return `<div class="invalid-feedback flex text-red-600 text-sm mt-1">
                        <p class="icon h-5 me-1"><i class="ri-error-warning-fill"></i></p>
                        <p class="message">Ukuran gambar >500kb</p>
                    </div>`;
        };

        noImageUploaded() {
            return `<div class="item-no-image flex items-center justify-between border border-light-grey rounded p-2">
                        <div class="image-info-wrapper w-11/12 flex items-center">
                            <div class="media h-12 w-12 grid place-items-center shrink-0 bg-accent text-secondary text-2xl text-center rounded me-2">
                                <div class="icon animate__animated animate__rubberBand animate__infinite"><i class="ri-upload-cloud-line"></i></div>
                            </div>
                            <div class="info">
                                <p class="text font-bold line-clamp-1 text-ellipsis">Tidak ada gambar.</p>
                            </div>
                        </div>
                    </div>`;
        };
    };

//  ==========================================================
//  Adjuster class for description textarea amount (add / sub)
//  ==========================================================
    class DescriptionAreaAdjuster {
        constructor(triggerEl) {
            this.triggerEl = triggerEl;
            this.triggerId = triggerEl.id;
            this.currTextareaId = document.querySelectorAll('.input-description').length;
            this.handleDescriptionArea();
        };

        handleDescriptionArea() {
            if (this.triggerId === 'btn-add-desc') {
                const descriptionInputWrapper = document.querySelector('#form-description');
                const nextTextareaClass = ['item-input-group','input-description', '|', 'mb-4'];

                const nextTextareaElement = toObjectHTML(nextTextareaClass, this.newTextarea(++this.currTextareaId));
                descriptionInputWrapper.insertAdjacentElement("beforeend", nextTextareaElement);

            } else if (this.triggerId === 'btn-del-desc') {
                const targetId = this.triggerEl.getAttribute('data-target-description');
                const targetElement = this.triggerEl.closest(`#${targetId}`);
                const targetDescTitle = targetElement.querySelector('input').value;

                targetElement.parentNode.remove();

                const title = "Berhasil Hapus Deskripsi";
                
                // If targetDescTitle has truthy value, that will be the value. If not then id will be. 
                const message = targetDescTitle || targetElement.id;

                showNotification(title, message);
            }
        };

        newTextarea(index) {
            return `<span class="block text-sm mb-1">Deskripsi</span>
                    <div id="form-input-desc-${index}" class="w-full">
                        <div class="flex gap-2 mb-4">
                            <input type="text" name="title_product_description[]" placeholder="Label Deskripsi..." class="w-full h-10 border border-[#ccc] rounded py-2 px-3 focus:ring-transparent">
                            <button type="button" id="btn-del-desc" class="btn-desc-adjuster bg-[#c33] text-white rounded py-2 px-3" data-target-description="form-input-desc-${index}">
                                <div class="icon h-6"><i class="ri-delete-bin-6-line"></i></div>
                            </button>
                        </div>
                        <textarea name="product_description[]" cols="30" rows="4" placeholder="Deskripsi..." class="w-full border border-[#ccc] rounded py-2 px-3 focus:ring-transparent"></textarea>
                    </div>`
        };
    }

//  ==========================================================
//  Switcher class for product detail form to description form
//  ========================================================== 
    class FormSwitcher {
        constructor(triggerEl, switcherButtons) {
            this.triggerEl = triggerEl;
            this.btnFormDetail = switcherButtons[0];
            this.btnFormDescription = switcherButtons[1];
            this.init();
        };

        init() {
            this.handleSwitchForm();
            this.handleReminderDot();
            this.handleSwitchButtonForm();
        };

        handleSwitchForm() {
            const targetFormType = this.triggerEl.getAttribute('data-target-form');
            const formDetail = document.querySelector('#form-detail');
            const formDescription = document.querySelector('#form-description');

            const showForm = targetFormType === 'form-detail' ? formDetail : formDescription;
            const hideForm = targetFormType === 'form-description' ? formDetail : formDescription;
        
            const toggleForm = {
                targetEl: showForm, 
                triggerEl: hideForm, 
                classToShow: 'block',
                classToHide: 'hidden', 
            };

            this.toggleClass(toggleForm);
        };

        handleReminderDot() {
            if (this.triggerEl.id === 'btn-form-detail') {
                const inputTitleDescValue = document.querySelector('.input-description input').value;
                const inputBodyDescValue = document.querySelector('.input-description textarea').value;
                const iconReminder = document.querySelector('.warning-field i');

                if (inputTitleDescValue && inputBodyDescValue) {
                    iconReminder.className = 'ri-check-double-fill';
                } else {
                    iconReminder.className = 'ri-error-warning-fill text-danger';
                };
            };
        };

        handleSwitchButtonForm() {
            const showButton = this.triggerEl.id === 'btn-form-detail' ? this.btnFormDescription : this.btnFormDetail;
            const hideButton = this.triggerEl.id === 'btn-form-description' ? this.btnFormDescription : this.btnFormDetail;

            const toggleButton = {
                targetEl: showButton, 
                triggerEl: hideButton, 
                classToShow: 'flex',
                classToHide: 'hidden', 
            };

            this.toggleClass(toggleButton);
        };

        toggleClass({targetEl, triggerEl, classToShow, classToHide}) {
            // Show target element
            targetEl.classList.remove(classToHide);
            targetEl.classList.add(classToShow);
            
            // Hide trigger element
            triggerEl.classList.add(classToHide);
            triggerEl.classList.remove(classToShow);
        };
    };

//  =================================================================
//                Dynamic image files list handler class
//  Making the image input files will be the same as the preview list
//  ================================================================= 
    class ImageFilesList {
        handleFileInputChange() {
            const newImageFiles = formInputImg.files;

            this.addFilesToImageList(newImageFiles);
            new ImageUploader();
        };

        addFilesToImageList(files) {
            const dt = new DataTransfer();

            // Object.values(object) => get object value in array, so that can use .foreach func
            const currImageFiles = Object.values(imageFiles);
            const formImageFiles = Object.values(files);

            // Add exists image to data transfer list
            currImageFiles.forEach(file => dt.items.add(file));

            // Add new input image to data transfer list
            formImageFiles.forEach(file => (!currImageFiles.some(e => e.name === file.name)) && dt.items.add(file));

            // Assign the updated list to Input Files List and imageFiles
            formInputImg.files = imageFiles = dt.files;
        };

        removeFileFromFilesList(elementIndex) {
            const dt = new DataTransfer();
            
            // Object.values(object) => get object value in array, so that can use .foreach func
            const currImageFiles = Object.values(imageFiles);

            // Exclude the selected file. Thus removing it.
            currImageFiles.forEach((file, index) => (elementIndex !== index) && dt.items.add(file));
            
            // Assign the updates list to Input Files List and imageFiles
            formInputImg.files = imageFiles = dt.files;
        };

        handleDragOver(e) {
            e.preventDefault();

            dropAreaImg.classList.add('dragover');
            browseImgBtn.classList.remove('z-20');
        };

        handleDragLeave() {
            dropAreaImg.classList.remove('dragover');
            browseImgBtn.classList.add('z-20');
        };

        handleDrop(e) {
            e.preventDefault();

            dropAreaImg.classList.remove('dragover');
            browseImgBtn.classList.add('z-20');

            const newImageFiles = e.dataTransfer.files;

            this.addFilesToImageList(newImageFiles);
            new ImageUploader();
        };
    };

    function removeImage(elementIndex) {
        const imageFilesList = new ImageFilesList();
        const listImage = document.querySelectorAll('.item-image-uploaded');
        const targetImage = listImage[elementIndex].querySelector('.action button');
        
        const title = "Berhasil Hapus Gambar"
        const message = targetImage.getAttribute('data-image-name');
        
        imageFilesList.removeFileFromFilesList(elementIndex);
        showNotification(title, message);
        
        new ImageUploader();
    };

    let imageFiles = {};
    const formInputImg = document.querySelector('#form-input-image');
    const dropAreaImg = document.querySelector('#drop-area-image');
    const browseImgBtn = document.querySelector('#browse-img');
    const uploadedImgWrapper = document.querySelector('.list-image-uploaded');

    const imageFilesList = new ImageFilesList();

    browseImgBtn.addEventListener('click', () => formInputImg.click());
    formInputImg.addEventListener('change', () => imageFilesList.handleFileInputChange());
    dropAreaImg.addEventListener('dragover', (e) => imageFilesList.handleDragOver(e));
    dropAreaImg.addEventListener('dragleave', () => imageFilesList.handleDragLeave());
    dropAreaImg.addEventListener('drop', (e) => imageFilesList.handleDrop(e));

    // Event delegation, so that there is no need to readjust dynamic elements 
    // + No need use MutationObserver
    // - But must be carefully of conflict with other element when clicked
    document.addEventListener('click', function(event) {
        let isDescAdjustButton = event.target.closest('.btn-desc-adjuster');
        let isFormSwitchButton = event.target.closest('.btn-form-switcher');
        const formSwitchButtons = document.querySelectorAll('.btn-form-switcher');

        if (isDescAdjustButton) {
            new DescriptionAreaAdjuster(isDescAdjustButton);
        } else if (isFormSwitchButton) {
            new FormSwitcher(isFormSwitchButton, formSwitchButtons);
        }
    });
</script>