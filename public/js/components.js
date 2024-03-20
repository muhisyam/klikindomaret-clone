export function toggleDropdown() { 
    const dropdownBtnList = document.querySelectorAll('button[data-target-dropdown]');

    dropdownBtnList.forEach(triggerEl => {
        triggerEl.addEventListener('click', () => {
            const btnArrow = triggerEl.querySelector('img[data-arrow-dropdown]');
            const triggerData = triggerEl.getAttribute('data-target-dropdown');
            const targetEl = document.querySelector('div[data-trigger-dropdown="' + triggerData + '"]');
            const isTargetClosed = targetEl.classList.contains('hidden');

            hideOpenedDropdown(targetEl);
            
            if (isTargetClosed) {
                triggerEl.classList.add('bg-dark-primary');
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
        triggerEl.addEventListener('click', () => {
            const triggerData = triggerEl.getAttribute('data-target-modal');
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

export function hideOpenedModal(el = null) { 
    let temp = [];
    temp.push(el);
     
    const modalList = el ? temp : document.querySelectorAll('.modal');
    if (! modalList) return;

    modalList.forEach(modal => modal.classList.remove('show'))
}

export function hideOpenedComponentsFromOutside() { 
    document.addEventListener('click', event => {
        const triggerEl = event.target.closest('button') ?? event.target;

        const isClickedInsideModal = ! document.querySelector('div[data-trigger-modal].show:not(.separated-modal)')?.contains(triggerEl);
        const isBtnClosedModal = ! triggerEl.matches('button[data-target-modal]');
        const isBtnSwitchModal = ! triggerEl.matches('button[data-switch-form]');
        const isBtnRemoveSelect2 = ! triggerEl.matches('button.select2-selection__choice__remove');
        const isPreventClose = ! triggerEl.matches('[prevent-close]');

        ! triggerEl.matches('button[data-target-dropdown]') ? hideOpenedDropdown() : '';
        isClickedInsideModal && isBtnClosedModal && isBtnSwitchModal && isBtnRemoveSelect2 && isPreventClose ? hideOpenedModal() : '';
    })
}

export function toggleActionDataTable() {
    const actionBtnList = document.querySelectorAll('button[data-target-action]');
    if (! actionBtnList) return;

    actionBtnList.forEach(triggerEl => {
        triggerEl.addEventListener('click', () => {
            const triggerData = triggerEl.getAttribute('data-target-action');
            const targetEl = document.querySelector(`div[data-trigger-action="${triggerData}"`);
            const isOpened = triggerEl.classList.contains('bg-tertiary', 'text-secondary');
            const triggerAction = triggerEl.querySelector('[action-icon-open]');
            const triggerClose = triggerEl.querySelector('[action-icon-close]');

            hideOpenedActionDataTable();
            
            if (!isOpened) {
                triggerEl.classList.add('bg-tertiary', 'text-secondary');
                triggerAction.classList.add('hidden');

                targetEl.classList.remove('hidden');
                triggerClose.classList.remove('hidden');
            };

            initTooltips();
        })
    })
}

function hideOpenedActionDataTable() {
    // Active Elements
    const activeActionBtnList = document.querySelectorAll('button[data-target-action].bg-tertiary');
    const activeActionElemenList = document.querySelectorAll('div[data-trigger-action]:not(.hidden)');
    
    activeActionBtnList.forEach(btnEl => {
        const triggerAction = btnEl.querySelector('[action-icon-open]');
        const triggerClose = btnEl.querySelector('[action-icon-close]');

        btnEl.classList.remove('bg-tertiary', 'text-secondary')
        triggerAction.classList.remove('hidden')
        triggerClose.classList.add('hidden')
    });

    activeActionElemenList.forEach(el => el.classList.add('hidden'));
}

/**
 * Convert from html string to node element
 * 
 * @param {string} parentTag - string
 * @param {array} parentClass - array
 * @param {string} innerBody - string
 */
export function createElement({parentTag = 'div', parentClass = [], innerBody = ''}) {
    const newHtmlObject = document.createElement(parentTag);

    newHtmlObject.classList.add(...parentClass);
    newHtmlObject.innerHTML = innerBody;

    return newHtmlObject;
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

export class SimpleImageUploader {
    constructor(formInputImg) {
        this.imageFile = formInputImg.files[0];
        this.imageUploadHandler();
    }

    imageUploadHandler() {
        let imageAttributes;
        let imageSize = Math.floor(this.imageFile.size / 1024);

        imageAttributes = {
            isInvalid: imageSize > 500 ? ' is-invalid' : '',
            imageUrl: URL.createObjectURL(this.imageFile),
            imageName: this.imageFile.name,
            imageSize: imageSize,
        };

        this.imageItemWrapper(imageAttributes);
    }

    shrinkBtnTrigger() {
        const browseImgBtn = document.querySelector('button[data-image-trigger]');

        browseImgBtn.classList.add('w-[0%]');
        browseImgBtn.classList.remove('w-full');
    }

    imageItemWrapper({isInvalid, imageUrl, imageName, imageSize}) {
        const uploadedImgWrapper = document.querySelector('div[data-image-target]');
        const iconImgBtn = document.querySelector('button[data-image-trigger] img');

        const imgNameClasses = 'text-sm text-secondary font-bold line-clamp-1';
        const imgNameInvalidClasses = 'text-[10px] font-light';

        const imgSizeClasses = 'text-[10px] font-light';
        const imgSizeInvalidClasses = 'text-sm text-red-600 font-bold';

        this.shrinkBtnTrigger();

        setTimeout(() => {
            const content = `<img class="p-1 h-9 rounded-lg" src="${imageUrl}">
                            <div class="h-9 leading-4">
                                <div class="${isInvalid ? imgNameInvalidClasses : imgNameClasses}" title="${imageName}">${imageName}</div>
                                <div class="${isInvalid ? imgSizeInvalidClasses : imgSizeClasses}">${imageSize} KB ${isInvalid && ' - Invalid Size! (>500KB)'}</div>
                            </div>`;
            
            uploadedImgWrapper.innerHTML = content;
            uploadedImgWrapper.classList.remove('opacity-0');
            
            isInvalid 
                ? uploadedImgWrapper.parentNode.classList.add('is-invalid') 
                : uploadedImgWrapper.parentNode.classList.remove('is-invalid');

            iconImgBtn.classList.add('rotate-[135deg]');
            iconImgBtn.classList.remove('rotate-45');
        }, 650);

    }
}

export function initTooltips() { 
    document.querySelectorAll('[data-tooltip-target]').forEach(function(triggerEl) {
        const tooltipId = triggerEl.getAttribute('data-tooltip-target');
        const placement = triggerEl.getAttribute('data-tooltip-placement');
        const tooltipEl = document.getElementById(tooltipId);

        new Tooltip(tooltipEl, triggerEl, placement);
    });
};
