<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Jquery just for convert purpose(✌ ͡• ₃ ͡•)✌
        $('#form-select-level').select2({
            width: '100%',
            placeholder: 'Pilih Level...',
        });

        $('#form-select-parent').select2({
            width: '100%',
            placeholder: 'Pilih Induk...',
        });

        $('#form-select-status').select2({
            width: '100%',
            placeholder: 'Pilih Status...',
        });
        // Thanks for the tolerance(👍 ͡• ₃ ͡•)👍


        const errorSelect = document.querySelectorAll('select[id^=form-select].is-invalid');
    
        errorSelect.forEach(el => {
            const s2Target = el.nextSibling;
            const s2wrapper = s2Target.querySelector('.select2-selection');

            s2wrapper.style.borderColor = '#dc2626';
        });
    });
    
    class Accordion {
        toogleAccordion(isHide, elContent, elBtn) { 
            if (isHide) {
                elContent.classList.remove('hide');
                elBtn.classList.add('active');
            } else {
                elContent.classList.add('hide');
                elBtn.classList.remove('active');
            }
        };

        ariaHiddenToogle(listEl) { 
            listEl.forEach(element => {
                const isActive = element.classList.contains('hide');

                return element.setAttribute('aria-hidden', isActive);
            });
        };

        ariaExpandedToogle(listEl) { 
            listEl.forEach(element => {
                const isActive = element.classList.contains('active');

                if (element.tagName.toLowerCase() != 'button') {
                    const elementButton = element.querySelector('.accordion-category-button button');
                    return elementButton.setAttribute('aria-expanded', isActive);
                }

                return element.setAttribute('aria-expanded', isActive);
            });
        };
    }

    class ImageUploader {
        constructor() {
            this.imageUploadHandler();
        }
    
        imageUploadHandler() { 
            isHasNewImage = true;
            let showImage = '';
            let fileImage = formInputImg.files[0];
    
            if (fileImage) {
                imageSize = Math.floor(fileImage.size / 1024);

                imageAttributes = {
                    isInvalid: imageSize > 500 ? ' is-invalid' : '',
                    imageUrl: URL.createObjectURL(fileImage),
                    imageName: fileImage.name,
                    imageSize: imageSize,
                };
                
                showImage += this.imageItemWrapper(imageAttributes);    
    
                uploadedImgWrapper.innerHTML = showImage;
            } else {
                uploadedImgWrapper.innerHTML = this.noImageUploaded();
            }
        }

        imageItemWrapper({isInvalid, imageUrl, imageName, imageSize}) {
            return `<div class="item-image-uploaded${isInvalid}">
                        <div class="image-item-wrapper flex items-center justify-between border border-[#eee] rounded p-2">
                            <div class="image-info-wrapper w-11/12 flex items-center">
                                <figure class="media shrink-0 me-2">
                                    <img class="h-12" src="${imageUrl}" alt="">
                                </figure>
                                <div class="info">
                                    <p class="text font-bold line-clamp-1 text-ellipsis">${imageName}</p>
                                    <p class="size text-xs font-light">${imageSize} KB</p>
                                </div>
                            </div>
                            <div class="action">
                                <button type="button" class="icon h-8 text-2xl rounded px-1 hover:bg-[#fbde7e] hover:text-[#0079c2]" onclick="deleteImage(this)" aria-label="Delete data image" data-original-image-name="${imageName}">
                                    <i class="ri-delete-bin-6-line"></i>
                                </button>
                            </div>
                        </div>
                        ${isInvalid ? this.invalidFeedback() : ''}
                    </div>`
        }
        
        invalidFeedback() { 
            return `<div class="invalid-feedback flex text-red-600 text-sm mt-1">
                        <p class="icon h-5 me-1"><i class="ri-error-warning-fill"></i></p>
                        <p class="message">Ukuran gambar >500kb</p>
                    </div>`
        }

        noImageUploaded() { 
            return `<div class="item-no-image flex items-center justify-between border border-[#eee] rounded p-2">
                        <div class="image-info-wrapper w-11/12 flex items-center">
                            <div class="media h-12 w-12 grid place-items-center shrink-0 bg-[#fbf0d0] text-[#0079c2] text-2xl text-center rounded me-2">
                                <div class="icon jump"><i class="ri-upload-cloud-line"></i></div>
                            </div>
                            <div class="info">
                                <p class="text font-bold line-clamp-1 text-ellipsis">Tidak ada gambar.</p>
                            </div>
                        </div>
                    </div>`
        }
    }

    // TODO: remove image
    function deleteImage(e) { 
        const title = "Berhasil Hapus Gambar"
        const message = e.getAttribute('data-original-image-name');

        formInputImg.value = '';
        
        deleteExistImage(e);
        showNotification(title, message);
        uploadImg();
    };

    function deleteExistImage(e) { 
        if (isHasNewImage) {
            return false;
        }

        let deleteExistImage = document.createElement("input");
        
        deleteExistImage.type = "text";
        deleteExistImage.name = "delete_image";
        deleteExistImage.value = e.getAttribute('data-image-name');
        deleteExistImage.classList.add('hidden');

        formInputImg.insertAdjacentElement('afterend', deleteExistImage);
    };

    // List subcategory page
    const accordion = new Accordion();
    const listSubCategoryRow = document.querySelectorAll('.accordion-category-item');

    listSubCategoryRow.forEach(subCategory => {
        const subCategoryBtn = subCategory.querySelector('.accordion-category-button button');

        subCategoryBtn.addEventListener('click', function () {
            const listAccordContent = document.querySelectorAll('.accordion-category-wrapper');
            const accordDataTarget = subCategoryBtn.getAttribute('data-accordion-target');
            const accordTarget = document.querySelector(`#${accordDataTarget}`);
            const isTargetHide = accordTarget.classList.contains('hide');

            accordion.toogleAccordion(isTargetHide, accordTarget, subCategory);
            accordion.ariaExpandedToogle(listSubCategoryRow);
            accordion.ariaHiddenToogle(listAccordContent);
        });
    });

    // Input subcategory page
    if (window.location.href.indexOf("create") > -1 || window.location.href.indexOf("edit") > -1) {
        const listSubCategoryBtn = document.querySelectorAll('.accordion-category-heading button');

        listSubCategoryBtn.forEach(subCategoryBtn => {
            subCategoryBtn.addEventListener('click', function () {
                const listAccordSubCategory = document.querySelectorAll('.accordion-category-content');
                const accordDataTarget = subCategoryBtn.getAttribute('data-accordion-target');
                const accordTarget = document.querySelector(`#${accordDataTarget}`);
                const isTargetHide = accordTarget.classList.contains('hide');

                hideAccordContent(listAccordSubCategory, accordDataTarget)
                activateButtonAccord(listSubCategoryBtn, accordDataTarget);
                toogleAccordion(isTargetHide, accordTarget, subCategoryBtn);
                ariaExpandedToogle(listSubCategoryBtn);
                ariaHiddenToogle(listAccordSubCategory);
            });
        });
        
        var isHasNewImage = false;
        var formInputImg = document.querySelector('#form-input-image');
        var uploadedImgWrapper = document.querySelector('.list-image-uploaded');
        const dropAreaImg = document.querySelector('#drop-area-image');
        const browseImgBtn = document.querySelector('#browse-img');
        const uploadedImgItem = document.querySelector('.item-image-uploaded');
        const noImageUploaded = document.querySelector('.item-no-image');
        const invalidFeedback = document.querySelector('.invalid-feedback');
        
        browseImgBtn.addEventListener('click', () => formInputImg.click());
        formInputImg.addEventListener('change', uploadImg);
        
        dropAreaImg.addEventListener('dragover', function(e) {
            e.preventDefault();

            dropAreaImg.classList.add('dragover');
            browseImgBtn.classList.remove('z-20');
        });

        dropAreaImg.addEventListener('dragleave', function() {
            dropAreaImg.classList.remove('dragover');
            browseImgBtn.classList.add('z-20');
        });

        dropAreaImg.addEventListener('drop', function(e) {
            e.preventDefault();

            dropAreaImg.classList.remove('dragover');
            browseImgBtn.classList.add('z-20');
            
            formInputImg.files = e.dataTransfer.files;
            uploadImg();
        });
    }
</script>