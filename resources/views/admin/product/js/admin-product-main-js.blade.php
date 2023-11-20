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

        // TODO: Tooltip name image
        imageUploader.prototype.imageItemWrapper = function (isInvalid, imageUrl, imageName, imageSize, index) {
            return `<div class="item-image-uploaded${isInvalid}">
                        <div class="image-item-wrapper flex items-center justify-between border border-[#eee] rounded p-2">
                            <div class="image-info-wrapper w-11/12 flex items-center">
                                <figure class="media shrink-0 me-2">
                                    <img class="h-12" src="${imageUrl}" alt="Product Image">
                                </figure>
                                <div class="info">
                                    <p class="text font-bold line-clamp-1 text-ellipsis" title="${imageName}">${imageName}</p>
                                    <p class="size text-xs font-light">${imageSize} KB</p>
                                </div>
                            </div>
                            <div class="action">
                                <button type="button" class="icon h-8 text-2xl rounded px-1 hover:bg-[#fbde7e] hover:text-[#0079c2]" onclick="deleteImage(${index})" aria-label="Delete data image" data-image-name="${imageName}">
                                    <i class="ri-delete-bin-6-line"></i>
                                </button>
                            </div>
                        </div>
                        ${isInvalid ? this.invalidFeedback() : ''}
                    </div>`;
        };

        imageUploader.prototype.noImageUploaded = function () {
            return `<div class="item-no-image flex items-center justify-between border border-[#eee] rounded p-2">
                        <div class="image-info-wrapper w-11/12 flex items-center">
                            <div class="media h-12 w-12 grid place-items-center shrink-0 bg-[#fbf0d0] text-[#0079c2] text-2xl text-center rounded me-2">
                                <div class="icon animate-bounce mt-2.5"><i class="ri-upload-cloud-line"></i></div>
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
            }
            
            let showImage = '';
            
            imageFiles.forEach((element, index) => {
                let imageUrl = URL.createObjectURL(element);
                let imageName = element.name;
                let imageSize = Math.floor(element.size / 1024);
                let isInvalid = imageSize > 500 ? ' is-invalid' : '';

                showImage += this.imageItemWrapper(isInvalid, imageUrl, imageName, imageSize, index);
            });

            return uploadedImgWrapper.innerHTML = showImage;
        };

        return imageUploader;
    }());

//  ==========================================================
//  Adjuster class for description textarea amount (add / sub)
//  ========================================================== 
    let currentTextareaId;
    
    let descriptionAreaAdjuster = (function () {
        function descriptionAreaAdjuster(triggerEl, adjusterButtons) {
            this.triggerEl = triggerEl;
            this.triggerId = triggerEl.id;
            this.btnAddDescription = adjusterButtons[0];
            this.btnDelDescription = adjusterButtons[1];
            this.init();
        }

        descriptionAreaAdjuster.prototype.init = function () {
            this.currTextarea();
            this.handleButtonTextareaAdjuster();
            this.handleDescriptionArea();
        };

        descriptionAreaAdjuster.prototype.currTextarea = function () {
            const listTextarea = document.querySelectorAll('[id^="addon"]');
            
            [...listTextarea].every((el, index) => {
                const isHidden = el.classList.contains('hidden');
                
                if (!isHidden) {
                    currentTextareaId = 5;
                    return true;
                } else {
                    currentTextareaId = index;
                    return false;
                }
            });
        };

        descriptionAreaAdjuster.prototype.handleButtonTextareaAdjuster = function () {
            if (this.triggerId === 'btn-add-desc') {
                this.btnDelDescription.classList.remove('hidden');
                this.btnDelDescription.classList.add('flex');
            } else if (this.triggerId === 'btn-del-desc') {
                this.btnAddDescription.classList.add('flex');
                this.btnAddDescription.classList.remove('hidden');
            }
        };

        descriptionAreaAdjuster.prototype.handleDescriptionArea = function () {
            const indexTextarea = this.triggerId === 'btn-add-desc' ? currentTextareaId + 1 : currentTextareaId;
            const textareaTarget = document.querySelector(`#addon-${indexTextarea}`);
            
            if (this.triggerId === 'btn-add-desc') {
                textareaTarget.classList.remove('hidden');
                currentTextareaId == 4 ? this.triggerEl.classList.add('hidden') : null;
            } else if (this.triggerId === 'btn-del-desc') {
                textareaTarget.classList.add('hidden');
                currentTextareaId == 2 ? this.triggerEl.classList.add('hidden') : null;
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

    const descAdjusterButtons = document.querySelectorAll('.btn-desc-adjuster');

    descAdjusterButtons.forEach(buttonElement => {
        buttonElement.addEventListener('click', function () { 
            new descriptionAreaAdjuster(buttonElement, descAdjusterButtons);
        });
    });
     
    const formSwitchButtons = document.querySelectorAll('.btn-form-switcher');

    formSwitchButtons.forEach(buttonElement => {
        buttonElement.addEventListener('click', function () { 
            new formSwitcher(buttonElement, formSwitchButtons);
        });
    });
</script>