// headerCategory();
toggleModal();
toggleDropdown();
handleSwitchForm();
hideOpenedComponentsFromOutside();
changePasswordVisibility();
selectVerifyVia();
smartOtpField();
resendOTPTimer();

function toggleDropdown() { 
    const dropdownBtnList = document.querySelectorAll('button[data-target-dropdown]');

    dropdownBtnList.forEach((triggerEl) => {
        triggerEl.addEventListener('click', (el) => {
            btnTrigger = el.target.closest('button'); // Find button element, when is clicked is not the button element
            btnArrow = btnTrigger.querySelector('img[data-arrow-dropdown]');
            triggerData = btnTrigger.getAttribute('data-target-dropdown');
            const targetEl = document.querySelector('div[data-trigger-dropdown="' + triggerData + '"]');
            const isTargetClosed = targetEl.classList.contains('hidden');

            hideOpenedDropdown(targetEl);
            
            if (isTargetClosed) {
                btnTrigger.classList.add('bg-dark-primary');
                btnArrow.classList.add('rotate-180');
                targetEl.classList.add('z-50');
                targetEl.classList.remove('hidden');
            } else {
                btnTrigger.classList.remove('bg-dark-primary');
                btnArrow.classList.remove('rotate-180');
                targetEl.classList.remove('z-50');
                targetEl.classList.add('hidden');
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
        const isElementOpen = ! dropdown.classList.contains('hidden');
        
        if (isElementOpen) {
            dropdown.classList.remove('z-50');
            dropdown.classList.add('hidden');
        }
    })
}

function toggleModal() { 
    const modalBtnList = document.querySelectorAll('button[data-target-modal]');

    modalBtnList.forEach((triggerEl) => {
        triggerEl.addEventListener('click', (el) => {
            btnTrigger = el.target.closest('button');
            triggerData = btnTrigger.getAttribute('data-target-modal');
            const targetEl = document.querySelector('div[data-trigger-modal*="' + triggerData + '"]:not(.separated-modal)');
            const isTargetOpened = targetEl.classList.contains('show');
            
            if (isTargetOpened) {
                hideOpenedModal(); 
            } else {
                btnTrigger.parentNode.classList.add('active');
                targetEl.classList.add('show');   
            }
        })
    })
}

function hideOpenedModal() { 
    const activeModalOverlay = document.querySelector('div[data-modal].active');
    if (! activeModalOverlay) { return }

    const modalList = document.querySelectorAll('.modal');

    activeModalOverlay.classList.remove('active');
    modalList.forEach(modal => modal.classList.remove('show'))
}

function handleSwitchForm() { 
    listBtnSwitch = document.querySelectorAll('button[data-switch-form]');
    loginForm = document.querySelector('div[data-trigger-modal*="login"]:not(.separated-modal)');
    registerForm = document.querySelector('div[data-trigger-modal*="register"]:not(.separated-modal)');
    registerBiodataForm = document.querySelector('section[data-section="register-complete-biodata"]');
    registerAuthForm = document.querySelector('section[data-section="register-complete-auth"]');

    listBtnSwitch.forEach(btnSwitch => {
        btnSwitch.addEventListener('click', (el) => {
            formTarget = el.target.getAttribute('data-switch-form');

            switch (formTarget) {
                case 'register':
                    loginForm.classList.remove('show');
                    registerForm.classList.add('show');
                    
                    break;
                case 'register-complete-biodata':
                    registerBiodataForm.classList.remove('hidden');
                    registerAuthForm.classList.add('hidden');

                    break;
                case 'register-complete-auth':
                    registerBiodataForm.classList.add('hidden');
                    registerAuthForm.classList.remove('hidden');
                
                    break;
                default:
                    loginForm.classList.add('show');
                    registerForm.classList.remove('show');

                    break;
            }
        })
    })
}

function hideOpenedComponentsFromOutside() { 
    document.addEventListener('click', (event) => {
        triggerEl = event.target.closest('button') ?? event.target;

        isButtonSwitch = triggerEl.matches('button[data-switch-form]');
        if (isButtonSwitch) { return }
        
        activeModalEl = document.querySelector('div[data-trigger-modal].show:not(.separated-modal)');
        if (! activeModalEl) { return }

        isButtonSwitchForm = activeModalEl.contains(triggerEl);
        if (isButtonSwitchForm) { return }

        ! triggerEl.matches('button[data-target-dropdown]') ? hideOpenedDropdown() : '';
        ! triggerEl.matches('button[data-target-modal]') ? hideOpenedModal() : '';
    })
}

function resendOTPTimer() {
    const resendOtp = document.querySelector('section[data-section="resend-otp"]');
    if (! resendOtp) { return } // Immediately return
    
    const formResendOTP = resendOtp.querySelector('form');
    let timerDisplay = resendOtp.querySelector('.message');
    let timeout = 30;
    let otpTimer = setInterval(() => {
        timeout--;
        timerDisplay.innerHTML = 'Kirim ulang OTP dalam ' + timeout + ' detik. ';
        if (timeout <= 0) {
            clearInterval(otpTimer);
            timerDisplay.innerHTML = 'Tidak mendapatkan kode?&nbsp;';
            formResendOTP.classList.remove('hidden');
        }
    }, 1000)
}

function changePasswordVisibility() { 
    btnVisibility = document.querySelectorAll('button[data-visibility]');
    if (! btnVisibility) { return }

    btnVisibility.forEach((btn) => {
        btn.addEventListener('click', () => {
            const changeVisibility = btn.getAttribute('data-visibility');
            const iconVisibily = btn.querySelector('img');
    
            if (changeVisibility === 'text') {
                iconVisibily.src = iconVisibily.src.replace('password', 'text');
                btn.previousElementSibling.type = changeVisibility;
                btn.setAttribute('data-visibility', 'password');
            } else {
                iconVisibily.src = iconVisibily.src.replace('text', 'password');
                btn.previousElementSibling.type = changeVisibility;
                btn.setAttribute('data-visibility', 'text');            
            }
        })
    })
}

function selectVerifyVia() { 
    btnViaInput = document.querySelectorAll('button[data-verify-via]');
    if (! btnViaInput) { return }


    btnViaInput.forEach((el) => {
        el.addEventListener('click', () => { 
            verifyVia = el.getAttribute('data-verify-via');
            document.querySelector('input[name="via"]').value = verifyVia;
        })
    })
}

function smartOtpField() { 
    btnSubmitOtp = document.querySelector('button[data-submit-form="verify-otp"]');
    if (! btnSubmitOtp) { return }

    otpInput = document.querySelectorAll('input[name*="otp_confirmation"]');

    otpInput.forEach((el, id) => {
        el.addEventListener('input', () => { 
            if (el.value.length > 0) {
                ! [...otpInput].some(e => e.value.trim() === '') ? btnSubmitOtp.click() : '';

                id !== otpInput.length - 1 ? otpInput[id+1].focus() : '';
            }
        })
    })
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
