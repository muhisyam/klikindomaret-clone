import * as component from './components.js';

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

function handleSwitchForm() { 
    const listBtnSwitch = document.querySelectorAll('button[data-switch-form]');
    const loginForm = document.querySelector('div[data-trigger-modal*="login"]:not(.separated-modal)');
    const registerForm = document.querySelector('div[data-trigger-modal*="register"]:not(.separated-modal)');
    const registerBiodataForm = document.querySelector('section[data-section="register-complete-biodata"]');
    const registerAuthForm = document.querySelector('section[data-section="register-complete-auth"]');

    listBtnSwitch.forEach(btnSwitch => {
        btnSwitch.addEventListener('click', (el) => {
            const formTarget = el.target.getAttribute('data-switch-form');

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
    const btnVisibility = document.querySelectorAll('button[data-visibility]');
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
    const btnViaInput = document.querySelectorAll('button[data-verify-via]');
    if (! btnViaInput) return;


    btnViaInput.forEach((el) => {
        el.addEventListener('click', () => { 
            const verifyVia = el.getAttribute('data-verify-via');
            document.querySelector('input[name="via"]').value = verifyVia;
        })
    })
}

function smartOtpField() { 
    const btnSubmitOtp = document.querySelector('button[data-submit-form="verify-otp"]');
    if (! btnSubmitOtp) return;

    const otpInput = document.querySelectorAll('input[name*="otp_confirmation"]');

    otpInput.forEach((el, id) => {
        el.addEventListener('input', () => { 
            if (el.value.length > 0) {
                ! [...otpInput].some(e => e.value.trim() === '') ? btnSubmitOtp.click() : '';

                id !== otpInput.length - 1 ? otpInput[id+1].focus() : '';
            }
        })
    })
}

new CategoryNavigation();

component.toggleDropdown();
component.toggleModal();
component.hideOpenedComponentsFromOutside();
component.initTooltips();
component.btnDataAction();
handleSwitchForm();
changePasswordVisibility();
selectVerifyVia();
smartOtpField();
resendOTPTimer();