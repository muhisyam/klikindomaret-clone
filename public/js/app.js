headerCategory();
toggleDropdown();
toggleLoginOrRegisterModal();
hideModalFromOutside();
handleButtonSwitchForm();
handleSwitchForm();
resendOTPTimer();
hideOpenedComponentsFromOutside();

function toggleDropdown() { 
    const dropdownBtnList = document.querySelectorAll('button[data-target-dropdown]');

    dropdownBtnList.forEach((triggerEl) => {
        triggerEl.addEventListener('click', (el) => {
            // Find button element, when is clicked is not the button element
            btnTrigger = el.target.closest('button');
            btnArrow = btnTrigger.querySelector('img[data-arrow-dropdown]');
            triggerData = btnTrigger.getAttribute('data-target-dropdown');
            const targetEl = document.querySelector('div[data-trigger-dropdown="' + triggerData + '"]');
            const isTargetClosed = targetEl.classList.contains('opacity-0');

            hideOpenedDropdown(targetEl);
            
            if (isTargetClosed) {
                btnTrigger.classList.add('bg-dark-primary');
                btnArrow.classList.add('rotate-180');
                targetEl.classList.add('opacity-100', 'z-50');
                targetEl.classList.remove('opacity-0');
            } else {
                btnTrigger.classList.remove('bg-dark-primary');
                btnArrow.classList.remove('rotate-180');
                targetEl.classList.remove('opacity-100', 'z-50');   
                targetEl.classList.add('opacity-0');   
            }
        })
    })
}

function hideOpenedDropdown() { 
    const dropdownBtnList = document.querySelectorAll('button[data-target-dropdown]');
    const dropdownList = document.querySelectorAll('div[data-trigger-dropdown]');

    dropdownBtnList.forEach((dropdownBtn) => {
        const isElementActive = dropdownBtn.classList.contains('bg-dark-primary');
        
        if (isElementActive) {
            const btnArrow = dropdownBtn.querySelector('img[data-arrow-dropdown]');
            dropdownBtn.classList.remove('bg-dark-primary');
            btnArrow.classList.remove('rotate-180');
        }
    })

    dropdownList.forEach((dropdown) => {
        const isElementOpen = dropdown.classList.contains('opacity-100');
        
        if (isElementOpen) {
            dropdown.classList.remove('opacity-100', 'z-50');
            dropdown.classList.add('opacity-0');
        }
    })
}

function toggleModal(classTarget, modalAction) { 
    // Check if modalTarget is already an object
    const modalAuth = typeof classTarget === 'object' ? classTarget : document.querySelector('.' + classTarget);
    const overlay = document.querySelector('#bg-overlay');
    
    if (modalAction === 'open') {
        overlay.classList.remove('hidden');
        modalAuth.classList.add('show');
    } else {
        overlay.classList.add('hidden');
        modalAuth.classList.remove('show');
    }
}

function toggleLoginOrRegisterModal() {
    const listBtnAuth = document.querySelectorAll('.button-auth');

    listBtnAuth.forEach(btnAuth => {
        btnAuth.addEventListener('click', (el) => {
            // Find button element, when is clicked is not the button element
            triggerEl = el.target.closest('button');
            modalOpen = triggerEl.getAttribute('data-modal-open');
            modalClose = triggerEl.getAttribute('data-modal-close');
            
            modalTarget = modalOpen ?? modalClose;
            modalAction = modalOpen ? 'open' : 'close';

            toggleModal(modalTarget, modalAction);
        });
    });
}

function hideModalFromOutside() {
    const overlay = document.querySelector('#bg-overlay');

    overlay.addEventListener('click', () => {
        const activeModal = document.querySelector('.modal.show');
        const modalAction = activeModal ? 'close' : '';

        toggleModal(activeModal, modalAction);
    });
}

function ensureInputFormNotEmpty() {
    birthdate = document.querySelector('#form-input-birthdate').value.trim();
    fullname = document.querySelector('#form-input-fullname').value.trim(); 
    username = document.querySelector('#form-input-username-registration').value.trim(); 
    password = document.querySelector('#form-input-password-registration').value.trim(); 

    listBtnSwitch = document.querySelectorAll('.button-switch-form');
    btnSubmit = document.querySelector('.button-submit-form');

    listBtnSwitch[0].setAttribute('disabled', '');
    btnSubmit.setAttribute('disabled', '');

    if (birthdate !== '' && fullname !== '') {
        if (username !== '' && password !== '') {
            btnSubmit.removeAttribute('disabled');
        }

        return listBtnSwitch[0].removeAttribute('disabled');
    }
}

function handleButtonSwitchForm() { 
    birthdate = document.querySelector('#form-input-birthdate');
    if (! birthdate) {return} // Immediately return
    fullname = document.querySelector('#form-input-fullname'); 
    username = document.querySelector('#form-input-username-registration'); 
    password = document.querySelector('#form-input-password-registration'); 

    birthdate.addEventListener('input', ensureInputFormNotEmpty);
    fullname.addEventListener('input', ensureInputFormNotEmpty);
    username.addEventListener('input', ensureInputFormNotEmpty);
    password.addEventListener('input', ensureInputFormNotEmpty);
}

function handleSwitchForm() { 
    listBtnSwitch = document.querySelectorAll('.button-switch-form');
    loginForm = document.querySelector('.login');
    registerForm = document.querySelector('.register');
    firstForm = document.querySelector('.first-form');
    secondForm = document.querySelector('.second-form');

    listBtnSwitch.forEach(btnSwitch => {
        btnSwitch.addEventListener('click', (el) => {
            formTarget = el.target.getAttribute('data-switch-form');

            switch (formTarget) {
                case 'register':
                    loginForm.classList.remove('show');
                    registerForm.classList.add('show');
                    
                    break;
                case 'section-first':
                    firstForm.classList.remove('hidden');
                    secondForm.classList.add('hidden');

                    break;
                case 'section-second':
                    firstForm.classList.add('hidden');
                    secondForm.classList.remove('hidden');
                
                    break;
                default:
                    loginForm.classList.add('show');
                    registerForm.classList.remove('show');

                    break;
            }
        });
    })
}

function hideOpenedComponentsFromOutside() { 
    document.addEventListener('click', (event) => {
        triggerEl = event.target.closest('button') ?? event.target;
        isDropdown = ! triggerEl.matches('button[data-target-dropdown]');

        if (isDropdown) {
            hideOpenedDropdown();
        }
    });
}

function resendOTPTimer() {
    // TODO: check if has rate limiter error
    let timerDisplay = document.querySelector('.resend-otp .message');
    if (! timerDisplay) {return} // Immediately return
    let timeout = 30;
    const formResendOTP = document.querySelector('.resend-otp form');
  
        let otpTimer = setInterval(function() {
            timeout--;
            timerDisplay.innerHTML = 'Kirim ulang OTP dalam ' + timeout + ' detik. ';
            if (timeout <= 0) {
                clearInterval(otpTimer);
                timerDisplay.innerHTML = 'Tidak mendapatkan kode?&nbsp;';
                formResendOTP.classList.remove('hidden');
            }
        }, 1000);
}



function headerCategory() {
    const btnCategory = document.querySelector('.bottom-section .category');
    const bottomHeaderWrapper = document.querySelector('.header .bottom-header .header-wrapper');
    
    function toggleCategoryButton() {
        const bottomHeader = document.querySelector('.header .bottom-header');
        const isWrapperHidden = bottomHeader.classList.contains('hidden');
        
        if (isWrapperHidden) {
            bottomHeader.classList.remove('hidden');
            bottomHeader.querySelector('.header-overlay').classList.remove('hidden');
        } else {
            bottomHeader.classList.add('hidden');
            bottomHeader.querySelector('.header-overlay').classList.add('hidden');
        }
    }
    
    btnCategory.addEventListener('click', function () { 
        toggleCategoryButton();
        document.querySelector('.item-menu-category').classList.add('active');
        document.querySelector('.list-category-wrapper').classList.remove('hidden');
        document.querySelector('.item-sub-level-1').classList.add('active');
        document.querySelector('.subcategory-header img').src = "https://assets.klikindomaret.com///products/banner/15-Icon-Makanan-R1.png";
        document.querySelector('.subcategory-header span').textContent = "Makanan";
        document.querySelector('.subcategory-level-2').classList.remove('hidden');
    });
    
    bottomHeaderWrapper.addEventListener('mouseleave', function () { 
        toggleCategoryButton();
        
        arrayItemMenu.map((linkMenu) => {
            return linkMenu.classList.remove('active');
        });

        arrayListCategory.map((categoryContent) => {
            return categoryContent.classList.add('hidden');
        });

        arraySubLevel1.map((subLevel1) => {
            return subLevel1.classList.remove('active');
        });
    });
    
    const categoryAllItemMenu = document.querySelectorAll('.header .bottom-header .top-section .item-menu-category');
    const categoryAllListCategory = document.querySelectorAll('.header .bottom-header .bottom-section .list-category-wrapper');
    const arrayItemMenu = [].slice.call(categoryAllItemMenu);
    const arrayListCategory = [].slice.call(categoryAllListCategory);
    
    arrayItemMenu.map((linkMenu) => {
        linkMenu.addEventListener('mouseenter', function () { 
            const menuAttribute = this.querySelector('a').getAttribute('data-menu-name').toLowerCase()

            arrayItemMenu.map((linkMenu) => { 
                linkMenu.classList.remove('active');
            });

            arrayListCategory.map((linkCategory) => { 
                const isCategoryHidden = linkCategory.classList.contains('hidden');
                return !isCategoryHidden ? linkCategory.classList.add('hidden') : '';
            });

            this.classList.add('active');
            document.querySelector('#category-' + menuAttribute).classList.remove('hidden');
        });
    });
    
    const subcategoryAllLevel1 = document.querySelectorAll('.header .bottom-header .bottom-section .left-side .item-sub-level-1');
    const subcategoryAllLevel2 = document.querySelectorAll('.header .bottom-header .bottom-section .right-side .subcategory-level-2');
    const arraySubLevel1 = [].slice.call(subcategoryAllLevel1);
    const arraySubLevel2 = [].slice.call(subcategoryAllLevel2);

    arraySubLevel1.map((subLevel1) => {
        subLevel1.addEventListener('mouseenter', function () { 
            const idCategory = this.getAttribute('data-category-id');
            const nameCategory = this.getAttribute('data-category-name');
            const imageCategory = this.getAttribute('data-category-image');
            

            arraySubLevel1.map((subLevel1) => {
                subLevel1.classList.remove('active');
            });
            
            arraySubLevel2.map((subLevel2) => {
                const subcategoryHeader = document.querySelector('.header .bottom-header .bottom-section .right-side .header-wrapper');
                const isSubcategory = subLevel2.classList.contains('subcategory-' + idCategory);
                
                subLevel2.classList.add('hidden');

                if (isSubcategory) {
                    subcategoryHeader.querySelector('img').src = imageCategory;
                    subcategoryHeader.querySelector('span').textContent = nameCategory;
                    subLevel2.classList.remove('hidden');
                }
                
                subLevel1.classList.add('active');
            });
        });
    });
}


