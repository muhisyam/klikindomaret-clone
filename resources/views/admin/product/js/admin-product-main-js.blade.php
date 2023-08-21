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

        convertRichText();

        function convertRichText() {
            const listTextarea = document.querySelectorAll('.item-input-group > #form-input-desc > #desc-info');
            listTextarea.forEach(el => {
                ClassicEditor
                    .create( el )
                    .catch( error => {
                        console.error( error );
                    } );
            });
        };
        
        const errorSelect = document.querySelectorAll('select[id^=form-select].is-invalid');
        
        errorSelect.forEach(el => {
            const s2Target = el.nextSibling;
            const s2wrapper = s2Target.querySelector('.select2-selection');

            s2wrapper.style.borderColor = '#dc2626';
        });
    });

    function callFeedback() { 
        const element = `<div class="invalid-feedback flex text-red-600 text-sm mt-1">
                            <p class="icon h-5 me-1"><i class="ri-error-warning-fill"></i></p>
                            <p class="message">Ukuran gambar >500kb</p>
                        </div>`
        
        return element;
    }

    function uploadImg() { 
        if (imageFiles.length !== 0) {
            let showImage = '';
            
            imageFiles.forEach((e, i) => {
                let imageUrl = URL.createObjectURL(e);
                let imageName = e.name;
                let imageSize = Math.floor(e.size / 1024);
                let isInvalid = '';
                let invalidFeedback = false;    

                if (imageSize > 500) {
                    isInvalid = ' is-invalid';
                    invalidFeedback = true;
                }

                showImage += `<div class="item-image-uploaded${isInvalid}">
                                <div class="image-item-wrapper flex items-center justify-between border border-[#eee] rounded p-2">
                                    <div class="image-info-wrapper w-11/12 flex items-center">
                                        <figure class="media shrink-0 me-2">
                                            <img class="h-12" src="${imageUrl}" alt="">
                                        </figure>
                                        <div class="info">
                                            <p class="text font-bold line-clamp-1 text-ellipsis" title="${imageName}">${imageName}</p>
                                            <p class="size text-xs font-light">${imageSize} KB</p>
                                        </div>
                                    </div>
                                    <div class="action">
                                        <button type="button" class="icon h-8 text-2xl rounded px-1 hover:bg-[#fbde7e] hover:text-[#0079c2]" onclick="deleteImage(${i})" aria-label="Delete data image">
                                            <i class="ri-delete-bin-6-line"></i>
                                        </button>
                                    </div>
                                </div>
                                ${invalidFeedback ? callFeedback() : ''}
                            </div>`
            });
            return uploadedImgWrapper.innerHTML = showImage;
        }

        const noImageUploaded = `<div class="item-no-image flex items-center justify-between border border-[#eee] rounded p-2">
                                    <div class="image-info-wrapper w-11/12 flex items-center">
                                        <div class="media h-12 w-12 grid place-items-center shrink-0 bg-[#fbf0d0] text-[#0079c2] text-2xl text-center rounded me-2">
                                            <div class="icon animate-bounce mt-2.5"><i class="ri-upload-cloud-line"></i></div>
                                        </div>
                                        <div class="info">
                                            <p class="text font-bold line-clamp-1 text-ellipsis">Tidak ada gambar.</p>
                                        </div>
                                    </div>
                                </div>`

        return uploadedImgWrapper.innerHTML = noImageUploaded;
    };

    let greetingText;
    const greetingBodyWrapper = document.querySelector('.greeting .body');

    function showNotification() { 
        if (!greetingText) {
            greetingText = document.querySelector('.greeting .greet-text');
            greetingText.classList.add('animate__animated', 'animate__bounceIn');
        }

        console.log(greetingText);
        
        greetingText ? greetingText.remove() : '';

        let notificationElement = `<div class="action-notification flex items-center animate__animated animate__bounceInRight">
                                        <div class="icon h-6 -ms-2 me-2"><i class="ri-delete-bin-6-fill"></i></div>
                                        <div class="info flex items-center text-sm">
                                            <h5 class="title me-1">Berhasil hapus gambar:</h5>
                                            <div class="desc max-w-[175px] whitespace-nowrap overflow-hidden text-xs">
                                                <p class="text relative animation-running" title="idyllic-shot-huge-mountain-covered-vegetation-with-body-water-its-base.jpg">idyllic-shot-huge-mountain-covered-vegetation-with-body-water-its-base.jpg</p>
                                            </div>
                                        </div>
                                        <button type="button" onclick="closeNotification()" class="close h-6 rounded-md px-1 ms-2 -me-4 hover:bg-[#0079c2] hover:text-[#fbde7e]"><i class="ri-close-line"></i></button>
                                    </div>
                                    <div class="timer-notification absolute left-0 bottom-0 w-full h-1 bg-[#0079c2]"></div>`

            
        greetingBodyWrapper.innerHTML = notificationElement;
        
        return interval = setInterval(updateCountdown, 1000);
    };

    let timerNotificationBar, interval;
    let totalTime = 10;
    let timeLeft = totalTime-1;

    function closeNotification() { 
        const notificationElement = document.querySelector('.greeting .action-notification');

        notificationElement ? notificationElement.remove() : '';
    
        clearInterval(interval);
        timerNotificationBar.style.width = '100%';

        return greetingBodyWrapper.appendChild(greetingText);
    };

    function updateProgressBar() {
        console.log((timeLeft / totalTime) * 100);
        const percentage = (timeLeft / totalTime) * 100;
        timerNotificationBar.style.width = percentage + '%';
    };

    function updateCountdown() {
        timerNotificationBar = document.querySelector('.timer-notification');

        updateProgressBar();

        timeLeft--;

        // Until the bar touch the end
        if (timeLeft < -1) {
            clearInterval(interval);
            timerNotificationBar.style.width = '100%';
        }
    };

    function deleteImage(i) { 
        imageFiles.splice(i, 1);
        
        showNotification();
        uploadImg();
    };

    var currentTextareaId;

    function currTextarea() { 
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
    }

    const btnAddDesc = document.querySelector('#btnAddDesc');
    const btnDelDesc = document.querySelector('#btnDelDesc');

    btnAddDesc.addEventListener('click', function() {
        currTextarea();

        const textareaTarget = document.querySelector(`#addon-${currentTextareaId+1}`);
        
        textareaTarget.classList.remove('hidden');
        btnDelDesc.classList.remove('hidden');

        if (currentTextareaId == 4) {
            btnAddDesc.classList.add('hidden');
        }
    });

    btnDelDesc.addEventListener('click', function() {
        currTextarea();
        const textareaTarget = document.querySelector(`#addon-${currentTextareaId}`);
       
        textareaTarget.classList.add('hidden');
        btnAddDesc.classList.remove('hidden');

        if (currentTextareaId == 2) {
            btnDelDesc.classList.add('hidden');
        }
        // hidden textare reset value
    });

    let imageFiles = [];
    const formInputImg = document.querySelector('#form-input-image');
    const dropAreaImg = document.querySelector('#drop-area-image');
    const browseImgBtn = document.querySelector('#browse-img');
    const uploadedImgWrapper = document.querySelector('.list-image-uploaded');
    const uploadedImgItem = document.querySelector('.item-image-uploaded');
    const noImageUploaded = document.querySelector('.item-no-image');
    const invalidFeedback = document.querySelector('.invalid-feedback');

    browseImgBtn.addEventListener('click', () => formInputImg.click());
    formInputImg.addEventListener('change', function () { 
        let imageFilesTemp = formInputImg.files;

        for (let i = 0; i < imageFilesTemp.length; i++) {
            imageFiles.every(e => e.name != imageFilesTemp[i].name) ? imageFiles.push(imageFilesTemp[i]) : '';
        };

        uploadImg();
    });

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
        
        let imageFilesTemp = e.dataTransfer.files;
        
        for (let i = 0; i < imageFilesTemp.length; i++) {
            imageFiles.every(e => e.name != imageFilesTemp[i].name) ? imageFiles.push(imageFilesTemp[i]) : '';
        };

        uploadImg();
    });

</script>