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
            let fileImage = formInputImg.files[0];
            let imageAttributes, imageSize;
            isHasNewImage = true;
            
            if (fileImage) {
                imageSize = Math.floor(fileImage.size / 1024);

                imageAttributes = {
                    isInvalid: imageSize > 500 ? ' is-invalid' : '',
                    imageUrl: URL.createObjectURL(fileImage),
                    imageName: fileImage.name,
                    imageSize: imageSize,
                };

                uploadedImgWrapper.innerHTML = this.imageItemWrapper(imageAttributes);;
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
                                <button type="button" class="icon h-8 text-2xl rounded px-1 hover:bg-[#fbde7e] hover:text-[#0079c2]" onclick="removeImage(this)" aria-label="Delete data image" data-original-image-name="${imageName}">
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

    class ImageFileHandler {
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
            
            formInputImg.files = e.dataTransfer.files;
            new ImageUploader();
        };
    }

    function removeImage(e) { 
        const title = "Berhasil Hapus Gambar"
        const message = e.getAttribute('data-original-image-name');

        formInputImg.value = '';
        
        deleteExistImage(e);
        showNotification(title, message);
        new ImageUploader();
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
        var isHasNewImage = false;
        var formInputImg = document.querySelector('#form-input-image');
        var uploadedImgWrapper = document.querySelector('.list-image-uploaded');
        var dropAreaImg = document.querySelector('#drop-area-image');
        var browseImgBtn = document.querySelector('#browse-img');

        const imageHandler = new ImageFileHandler();
        
        browseImgBtn.addEventListener('click', () => formInputImg.click());
        formInputImg.addEventListener('change', () => new ImageUploader());
        dropAreaImg.addEventListener('dragover', (e) => imageHandler.handleDragOver(e));
        dropAreaImg.addEventListener('dragleave', () => imageHandler.handleDragLeave());
        dropAreaImg.addEventListener('drop', (e) => imageHandler.handleDrop(e));
    }
</script>