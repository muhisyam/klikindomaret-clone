export function toggleDropdown() { 
    const dropdownBtnList = document.querySelectorAll('button[data-target-dropdown]');

    dropdownBtnList.forEach(triggerEl => {
        triggerEl.addEventListener('click', el => {
            const btnTrigger = el.target.closest('button'); // Find button element, when is clicked is not the button element
            const btnArrow = btnTrigger.querySelector('img[data-arrow-dropdown]');
            const triggerData = btnTrigger.getAttribute('data-target-dropdown');
            const targetEl = document.querySelector('div[data-trigger-dropdown="' + triggerData + '"]');
            const isTargetClosed = targetEl.classList.contains('hidden');

            hideOpenedDropdown(targetEl);
            
            if (isTargetClosed) {
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

export function toggleModal() { 
    const modalBtnList = document.querySelectorAll('button[data-target-modal]');

    modalBtnList.forEach(triggerEl => {
        triggerEl.addEventListener('click', el => {
            const btnTrigger = el.target.closest('button');
            const triggerData = btnTrigger.getAttribute('data-target-modal');
            const targetEl = document.querySelectorAll('div[data-trigger-modal*="' + triggerData + '"]');

            targetEl.forEach(el => {
                const isTargetOpened = el.classList.contains('show');

                if (isTargetOpened) {
                    hideOpenedModal(el); 
                } else {
                    el.classList.add('show'); 
                }     
            })
        })
    })
}

function hideOpenedModal(el = null) { 
    let temp = [];
    temp.push(el);
     
    const modalList = el ? temp : document.querySelectorAll('.modal');
    if (! modalList) return;

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

export function hideOpenedComponentsFromOutside() { 
    document.addEventListener('click', event => {
        const triggerEl = event.target.closest('button') ?? event.target;

        const isClickedInsideModal = ! document.querySelector('div[data-trigger-modal].show:not(.separated-modal)')?.contains(triggerEl);
        const isBtnClosedModal = ! triggerEl.matches('button[data-target-modal]');
        const isBtnSwitchModal = ! triggerEl.matches('button[data-switch-form]');

        ! triggerEl.matches('button[data-target-dropdown]') ? hideOpenedDropdown() : '';
        isClickedInsideModal && isBtnClosedModal && isBtnSwitchModal ? hideOpenedModal() : '';
    })
}


var Tooltip = (function () { 
    function Tooltip(targetEl, triggerEl, placementEl) {
        this._targetEl = targetEl;
        this._triggerEl = triggerEl;
        this._placementEl = placementEl;
        this._init();
    }

    Tooltip.prototype._init = function () {
        if (this._triggerEl) {
            this._setupEventListeners();
            this._setupAttribute();
        }
    };

    Tooltip.prototype._setupAttribute = function () {
        this._targetEl.setAttribute('data-popper-placement', this._placementEl);
    };

    Tooltip.prototype._setupEventListeners = function () {
        var _this = this;
        _this._handleStyle();
        this._triggerEl.addEventListener('mouseenter', function() {
            _this.show();
        });
        this._triggerEl.addEventListener('mouseleave', function() {
            _this.hide();
        });
    };

    Tooltip.prototype._handleStyle = function () {
        var _this = this;
        const arrow = this._targetEl.querySelector('.tooltip-arrow');

        _this._setupStyleElement(arrow);
        _this._setupStyleArrow(arrow);
    };

    Tooltip.prototype._setupStyleElement = function (arrow) {
        const translateX = this._triggerEl.offsetLeft + (this._triggerEl.offsetWidth - this._targetEl.offsetWidth) / 2;
        const translateY = this._triggerEl.offsetTop + this._triggerEl.offsetHeight + arrow.offsetHeight;

        this._targetEl.style.position = 'absolute';
        this._targetEl.style.inset = '0px auto auto 0px';
        this._targetEl.style.margin = '0px';
        this._targetEl.style.transform = `translate3d(${translateX}px, ${translateY}px, 0px)`;
    };

    Tooltip.prototype._setupStyleArrow = function (arrow) {
        const translateX = (this._targetEl.offsetWidth / 2) - (arrow.offsetWidth / 2);
        
        arrow.style.position = 'absolute';
        arrow.style.left = '0px';
        arrow.style.transform = `translate3d(${translateX}px, 0px, 0px)`;
    };

    Tooltip.prototype.show = function () {
        this._targetEl.classList.remove('opacity-0', 'invisible');
        this._targetEl.classList.add('opacity-100', 'visible');
    };

    Tooltip.prototype.hide = function () {
        this._targetEl.classList.remove('opacity-100', 'visible');
        this._targetEl.classList.add('opacity-0', 'invisible');
    };

    return Tooltip;
}());

export function initTooltips() { 
    document.querySelectorAll('[data-tooltip-target]').forEach(function(triggerEl) {
        const tooltipId = triggerEl.getAttribute('data-tooltip-target');
        const placement = triggerEl.getAttribute('data-tooltip-placement');
        const tooltipEl = document.getElementById(tooltipId);

        new Tooltip(tooltipEl, triggerEl, placement);
    });
};

export function btnDataAction(triggerEl) {
    if (! triggerEl) return;

    const actionId = triggerEl.getAttribute('data-target-action');
    const actionEl = document.querySelector(`#${actionId}-action`);
    const isOpened = triggerEl.classList.contains('bg-tertiary', 'text-secondary');
    const triggerAction = triggerEl.querySelector('.icon-action');
    const triggerClose = triggerEl.querySelector('.icon-close');

    actionEl.classList.toggle('hidden');
    
    if (isOpened) {
        triggerEl.classList.remove('bg-tertiary', 'text-secondary')
    } else {
        triggerEl.classList.add('bg-tertiary', 'text-secondary')
    };

    triggerAction.classList.toggle('hidden');
    triggerClose.classList.toggle('hidden');

    initTooltips();
}
