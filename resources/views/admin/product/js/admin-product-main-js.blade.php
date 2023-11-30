<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Jquery just for convert purpose(✌ ͡• ₃ ͡•)✌
        $('#form-select-category').select2({
            width: '100%',
            placeholder: 'Pilih Kategori...',
        });

        $('#form-select-store').select2({
            width: '100%',
            placeholder: 'Pilih Toko...',
        });

        $('#form-select-product-status').select2({
            width: '100%',
            placeholder: 'Pilih Status...',
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
    let imageUploader = (function () {
        function imageUploader() {
            this.init();
        }

        imageUploader.prototype.init = function () {
            this.imageUploadHandler();
        };

        imageUploader.prototype.invalidFeedback = function () {
            return `<div class="invalid-feedback flex text-red-600 text-sm mt-1">
                        <p class="icon h-5 me-1"><i class="ri-error-warning-fill"></i></p>
                        <p class="message">Ukuran gambar >500kb</p>
                    </div>`;
        };

        imageUploader.prototype.imageItemWrapper = function (isInvalid, imageUrl, imageName, imageSize, index) {
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
                                <button type="button" class="icon h-8 text-2xl rounded px-1 hover:bg-tertiary hover:text-secondary" onclick="deleteImage(${index})" aria-label="Delete data image" data-image-name="${imageName}">
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

        imageUploader.prototype.noImageUploaded = function () {
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

        imageUploader.prototype.imageUploadHandler = function () {
            if (imageFiles.length == 0) {
                return uploadedImgWrapper.innerHTML = this.noImageUploaded();
            } else {
                let showImage = '';
                
                imageFiles.forEach((element, index) => {
                    let imageUrl = URL.createObjectURL(element);
                    let imageName = element.name;
                    let imageSize = Math.floor(element.size / 1024);
                    let isInvalid = imageSize > 500 ? ' is-invalid' : '';
    
                    showImage += this.imageItemWrapper(isInvalid, imageUrl, imageName, imageSize, index);
                });
    
                uploadedImgWrapper.innerHTML = showImage;
                initTooltips();
            };
        };

        return imageUploader;
    }());

//  ==========================================================
//  Adjuster class for description textarea amount (add / sub)
//  ========================================================== 
    let currentTextareaId = 1;
    
    let descriptionAreaAdjuster = (function () {
        function descriptionAreaAdjuster(triggerEl) {
            this.triggerEl = triggerEl;
            this.triggerId = triggerEl.id;
            this.init();
        }

        descriptionAreaAdjuster.prototype.init = function () {
            this.handleDescriptionArea();
        };

        descriptionAreaAdjuster.prototype.newTextarea = function (index) {
            return `<label for="form-input-desc-${index}" class="block text-sm mb-1">Deskripsi</label>
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

        descriptionAreaAdjuster.prototype.handleDescriptionArea = function () {
            if (this.triggerId === 'btn-add-desc') {
                const descriptionInputWrapper = document.querySelector('#form-description');
                const nextTextareaClass = ['item-input-group', 'mb-4'];

                nextTextareaElement = toObjectHTML(nextTextareaClass, this.newTextarea(++currentTextareaId));
                descriptionInputWrapper.insertAdjacentElement("beforeend", nextTextareaElement);

            } else if (this.triggerId === 'btn-del-desc') {
                const targetId = this.triggerEl.getAttribute('data-target-description');
                const targetElement = document.querySelector(`#${targetId}`);

                targetElement.parentNode.remove();

                const title = "Berhasil Hapus Deskripsi"
                const message = targetElement.id;

                showNotification(title, message);
            }
        };

        return descriptionAreaAdjuster;
    }());

//  ==========================================================
//  Switcher class for product detail form to description form
//  ========================================================== 
    let formSwitcher = (function () {
        function formSwitcher(triggerEl, switcherButtons) {
            this.triggerEl = triggerEl;
            this.btnFormDetail = switcherButtons[0];
            this.btnFormDescription = switcherButtons[1];
            this.init();
        }

        formSwitcher.prototype.init = function () {
            this.handleSwitchForm();
            this.handleSwitchButtonForm();
        };

        formSwitcher.prototype.handleSwitchForm = function () {
            const targetFormType = this.triggerEl.getAttribute('data-target-form');
            const formDetail = document.querySelector('#form-detail');
            const formDescription = document.querySelector('#form-description');

            const showForm = targetFormType === 'form-detail' ? formDetail : formDescription;
            const hideForm = targetFormType === 'form-description' ? formDetail : formDescription;
        
            this.toggleClass(showForm, hideForm, 'hidden', 'block');
        };

        formSwitcher.prototype.handleSwitchButtonForm = function () {
            const showButton = this.triggerEl.id === 'btn-form-detail' ? this.btnFormDescription : this.btnFormDetail;
            const hideButton = this.triggerEl.id === 'btn-form-description' ? this.btnFormDescription : this.btnFormDetail;

            this.toggleClass(showButton, hideButton, 'hidden', 'flex');
        };

        formSwitcher.prototype.toggleClass = function (targetEl, triggerEl, classToHide, classToShow) {
            // Show target element
            targetEl.classList.remove(classToHide);
            targetEl.classList.add(classToShow);
            // Hide trigger element
            triggerEl.classList.add(classToHide);
            triggerEl.classList.remove(classToShow);
        };

        return formSwitcher;
    }());

    function addFilesToImageList(files) {
        for (let i = 0; i < files.length; i++) {
            if (!imageFiles.some(e => e.name === files[i].name)) {
                imageFiles.push(files[i]);
            }
        }
    }

    function handleFileInputChange() {
        let imageFilesTemp = formInputImg.files;

        addFilesToImageList(imageFilesTemp);
        new imageUploader();
    }

    function handleDragOver(e) {
        e.preventDefault();

        dropAreaImg.classList.add('dragover');
        browseImgBtn.classList.remove('z-20');
    }

    function handleDragLeave() {
        dropAreaImg.classList.remove('dragover');
        browseImgBtn.classList.add('z-20');
    }

    function handleDrop(e) {
        e.preventDefault();

        dropAreaImg.classList.remove('dragover');
        browseImgBtn.classList.add('z-20');

        let imageFilesTemp = e.dataTransfer.files;

        addFilesToImageList(imageFilesTemp);
        new imageUploader();
    }
    
    function deleteImage(elementIndex) {
        const listImage = document.querySelectorAll('.item-image-uploaded');
        const targetImage = listImage[elementIndex].querySelector('.action button');
        
        const title = "Berhasil Hapus Gambar"
        const message = targetImage.getAttribute('data-image-name');

        imageFiles.splice(elementIndex, 1);
        new imageUploader();
        showNotification(title, message);
    };

    let imageFiles = [];
    const formInputImg = document.querySelector('#form-input-image');
    const dropAreaImg = document.querySelector('#drop-area-image');
    const browseImgBtn = document.querySelector('#browse-img');
    const uploadedImgWrapper = document.querySelector('.list-image-uploaded');

    browseImgBtn.addEventListener('click', () => formInputImg.click());
    formInputImg.addEventListener('change', handleFileInputChange);
    dropAreaImg.addEventListener('dragover', handleDragOver);
    dropAreaImg.addEventListener('dragleave', handleDragLeave);
    dropAreaImg.addEventListener('drop', handleDrop);

    // Event delegation, so that there is no need to readjust dynamic elements 
    // + No need use MutationObserver
    // - But must be carefully of conflict with other element when clicked
    document.addEventListener('click', function(event) {
        let isDescAdjustButton = event.target.closest('.btn-desc-adjuster');
        let isFormSwitchButton = event.target.closest('.btn-form-switcher');
        const formSwitchButtons = document.querySelectorAll('.btn-form-switcher');

        if (isDescAdjustButton) {
            new descriptionAreaAdjuster(isDescAdjustButton);
        }else if (isFormSwitchButton) {
            new formSwitcher(isFormSwitchButton, formSwitchButtons);
        }
    });
</script>