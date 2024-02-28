function toggleDropdown() { 
    const dropdownBtnList = document.querySelectorAll('button[data-target-dropdown]');

    dropdownBtnList.forEach(triggerEl => {
        triggerEl.addEventListener('click', el => {
            btnTrigger = el.target.closest('button'); // Find button element, when is clicked is not the button element
            btnArrow = btnTrigger.querySelector('img[data-arrow-dropdown]');
            triggerData = btnTrigger.getAttribute('data-target-dropdown');
            const targetEl = document.querySelector('div[data-trigger-dropdown="' + triggerData + '"]');
            const isTargetClosed = targetEl.classList.contains('hidden');

            hideOpenedDropdown(targetEl);
            
            if (isTargetClosed) {
                toggleComponentOverlay(btnTrigger, false);

                btnTrigger.classList.add('bg-dark-primary');
                btnArrow.classList.add('rotate-180');
                targetEl.classList.add('z-50');
                targetEl.classList.remove('hidden');
            } else {
                hideOpenedDropdown();
            }
        })
    })
}

function hideOpenedDropdown() { 
    const dropdownBtnList = document.querySelectorAll('button[data-target-dropdown]');
    const dropdownList = document.querySelectorAll('div[data-trigger-dropdown]');

    dropdownBtnList.forEach(dropdownBtn => {
        const isElementActive = dropdownBtn.classList.contains('bg-dark-primary');
        
        if (isElementActive) {
            const btnArrow = dropdownBtn.querySelector('img[data-arrow-dropdown]');
            dropdownBtn.classList.remove('bg-dark-primary');
            btnArrow.classList.remove('rotate-180');

            toggleComponentOverlay(dropdownBtn);
        }
    })

    dropdownList.forEach(dropdown => {
        const isElementOpen = ! dropdown.classList.contains('hidden');
        
        if (isElementOpen) {
            dropdown.classList.remove('z-50');
            dropdown.classList.add('hidden');
        }
    })
}

function toggleModal() { 
    const modalBtnList = document.querySelectorAll('button[data-target-modal]');

    modalBtnList.forEach(triggerEl => {
        triggerEl.addEventListener('click', el => {
            btnTrigger = el.target.closest('button');
            triggerData = btnTrigger.getAttribute('data-target-modal');
            const targetEl = document.querySelector('div[data-trigger-modal*="' + triggerData + '"]:not(.separated-modal)');
            const isTargetOpened = targetEl.classList.contains('show');
            
            if (isTargetOpened) {
                hideOpenedModal(); 
            } else {
                toggleComponentOverlay(btnTrigger, false);
                targetEl.classList.add('show');   
            }
        })
    })
}

function hideOpenedModal() { 
    const activeModalOverlay = document.querySelector('div[data-modal][overlay="active"]');
    if (! activeModalOverlay) return;

    const modalList = document.querySelectorAll('.modal');

    toggleComponentOverlay(activeModalOverlay);
    modalList.forEach(modal => modal.classList.remove('show'))
}

function toggleComponentOverlay(btnTrigger, hide = true) {
    const componentWrapper = btnTrigger.matches('button') ? btnTrigger.parentNode : btnTrigger;

    if (componentWrapper.hasAttribute('overlay')) {
        const body = document.querySelector('body');
        
        if (hide) {
            componentWrapper.setAttribute('overlay', '');
            body.classList.remove('overflow-hidden');
        } else {
            componentWrapper.setAttribute('overlay', 'active');
            body.classList.add('overflow-hidden');
        }
    }    
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
    document.addEventListener('click', event => {
        triggerEl = event.target.closest('button') ?? event.target;

        isClickedInsideModal = ! document.querySelector('div[data-trigger-modal].show:not(.separated-modal)')?.contains(triggerEl);
        isBtnClosedModal = ! triggerEl.matches('button[data-target-modal]');
        isBtnSwitchModal = ! triggerEl.matches('button[data-switch-form]');

        ! triggerEl.matches('button[data-target-dropdown]') ? hideOpenedDropdown() : '';
        isClickedInsideModal && isBtnClosedModal && isBtnSwitchModal ? hideOpenedModal() : '';
    })
}

function resendOTPTimer() {
    const resendOtp = document.querySelector('section[data-section="resend-otp"]');
    if (! resendOtp) return; // Immediately return
    
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
    if (! btnVisibility) return;

    btnVisibility.forEach(btn => {
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
    if (! btnViaInput) return;


    btnViaInput.forEach((el) => {
        el.addEventListener('click', () => { 
            verifyVia = el.getAttribute('data-verify-via');
            document.querySelector('input[name="via"]').value = verifyVia;
        })
    })
}

function smartOtpField() { 
    btnSubmitOtp = document.querySelector('button[data-submit-form="verify-otp"]');
    if (! btnSubmitOtp) return;

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

class CategoryNavigation {
    constructor() {
        this.targetContent;
        this.targetSubCategory;

        this.init();
    }

    init() {
        const catNavMenu = document.querySelectorAll('[data-target-category-content]');
        if (! catNavMenu) return;

        catNavMenu.forEach(menu => {
            menu.addEventListener('mouseenter', () => {
                this.activatingMenu(catNavMenu, false);
                
                this.targetContent = menu.getAttribute('data-target-category-content');
                const catNavContentList = document.querySelectorAll('[data-category-content]');
                
                this.activatingMenu([menu]);
                this.resetElementsClass(catNavContentList);
                this.switchContent('[data-category-content="' + this.targetContent + '"]');
                
                if (this.targetContent === 'retail') this.retailContent();
            })
        })
    };

    retailContent() {
        const triggerList = document.querySelectorAll('[data-target-retail]');

        triggerList.forEach(triggerEl => {
            triggerEl.addEventListener('mouseenter', () => {
                this.targetSubCategory = triggerEl.getAttribute('data-target-retail');
                const targetList = document.querySelectorAll('[data-trigger-retail]');

                this.resetElementsClass(targetList);
                this.switchContent('[data-trigger-retail="' + this.targetSubCategory + '"]');
            })

        });
    }

    activatingMenu(listEl, active = true) {
        const menuActiveClass = ['border-b', 'border-secondary', 'text-secondary'];
        const iconInactiveClass= ['brightness-95', 'grayscale-[90%]'];

        return listEl.forEach(el => {
            if (active) {
                el.classList.add(...menuActiveClass);
                el.querySelector('img').classList.remove(...iconInactiveClass);
            } else {
                el.classList.remove(...menuActiveClass);
                el.querySelector('img').classList.add(...iconInactiveClass);
            }
        })
    }

    resetElementsClass(listEl, toggleClass = 'hidden') {
        return listEl.forEach(el => {
            el.classList.add(toggleClass);
        })
    }

    switchContent(attr, toggleClass = 'hidden') {
        return document.querySelector(attr).classList.remove(toggleClass);
    }
};

toggleModal();
toggleDropdown();
handleSwitchForm();
hideOpenedComponentsFromOutside();
changePasswordVisibility();
selectVerifyVia();
smartOtpField();
resendOTPTimer();

new CategoryNavigation();