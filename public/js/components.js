// MARK: Dropdown
export function toggleDropdown() { 
    const dropdownBtnList = document.querySelectorAll('button[data-target-dropdown]');

    dropdownBtnList.forEach(triggerEl => {
        triggerEl.removeEventListener('click', dropdownClickHandler);
        triggerEl.addEventListener('click', dropdownClickHandler);
    })
}

function dropdownClickHandler(event) {
    const triggerEl      = event.currentTarget;
    const btnArrow       = triggerEl.querySelector('img[data-arrow-dropdown]');
    const targetIndetity = triggerEl.getAttribute('data-target-dropdown');
    const targetEl       = document.querySelector(`div[data-trigger-dropdown="${targetIndetity}"]`);
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
}

function hideOpenedDropdown() { 
    const dropdownBtnList = document.querySelectorAll('button[data-target-dropdown]');
    const dropdownList    = document.querySelectorAll('div[data-trigger-dropdown]');

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

// MARK: Modal
export function toggleModal() { 
    const modalBtnList = document.querySelectorAll('button[data-target-modal]');

    modalBtnList.forEach(triggerEl => {
        triggerEl.removeEventListener('click', modalClickHandler);
        triggerEl.addEventListener('click', modalClickHandler);
    })
}

function modalClickHandler(event) {
    const triggerEl      = event.currentTarget;
    const targetIndetity = triggerEl.getAttribute('data-target-modal');
    const targetEl       = document.querySelectorAll(`div[data-trigger-modal*="${targetIndetity}"]`);

    targetEl.forEach(el => {
        const isTargetOpened = el.classList.contains('show');

        if (isTargetOpened) {
            hideOpenedModal(el); 
        } else {
            el.classList.add('show');
            hideLoader();
        }     
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

        const notBtnDropdown        = ! triggerEl.matches('button[data-target-dropdown]');
        const notClickedInsideModal = ! document.querySelector('div[data-trigger-modal].show:not(.separated-modal)')?.contains(triggerEl);
        const notBtnClosedModal     = ! triggerEl.matches('button[data-target-modal]');
        const notBtnSwitchModal     = ! triggerEl.matches('button[data-switch-form]');
        const notBtnRemoveSelect2   = ! triggerEl.matches('button.select2-selection__choice__remove');
        const notPreventClose       = ! triggerEl.hasAttribute('prevent-close');

        notBtnDropdown ? hideOpenedDropdown() : '';
        notClickedInsideModal && notBtnClosedModal && notBtnSwitchModal && notBtnRemoveSelect2 && notPreventClose ? hideOpenedModal() : '';
    })
}

// MARK: Table action menu
/**
 * Handle open/close data table action
 */
export function toggleActionDataTable() {
    const actionBtnList = document.querySelectorAll('button[data-target-action]');
    if (! actionBtnList) return;

    actionBtnList.forEach(triggerEl => {
        triggerEl.removeEventListener('click', actionDataTableHandler);
        triggerEl.addEventListener('click', actionDataTableHandler);
    })
}

function actionDataTableHandler(event) {
    const triggerEl      = event.currentTarget;
    const targetIndetity = triggerEl.getAttribute('data-target-action');
    const targetEl       = document.querySelector(`div[data-trigger-action="${targetIndetity}"`);
    const isOpened       = triggerEl.classList.contains('open');

    hideOpenedActionDataTable();

    if (! isOpened) {
        triggerEl.classList.add('open');
        targetEl.classList.add('open');

        setTimeout(() => {
            targetEl.classList.remove('opacity-0');
            targetEl.classList.add('opacity-100');
        }, 650);
    };

    initTooltips();
} 

function hideOpenedActionDataTable() {
    const activeActionElemenList = document.querySelectorAll('div[data-trigger-action].open');
    const activeActionBtnList    = document.querySelectorAll('button[data-target-action].open');

    activeActionElemenList.forEach(el => {
        el.classList.add('opacity-0');
        el.classList.remove('opacity-100', 'open');
    });

    activeActionBtnList.forEach(btnEl => setTimeout(() => { btnEl.classList.remove('open') }, 700));
}

// MARK: Input product qty
export function handleInputProductQty() { 
    const btnHandlerQtyList = document.querySelectorAll('button[qty]');

    btnHandlerQtyList.forEach(btnHandlerQty => {
        btnHandlerQty.addEventListener('click', event => {
            let inputQty, qtyValue;
            const btnQty        = event.target.closest('button') ?? event.target;
            const btnAttrMethod = btnQty.getAttribute('qty');

            switch (btnAttrMethod) {
                case 'sub':
                    inputQty       = btnQty.nextElementSibling;
                    qtyValue       = parseInt(inputQty.value);
                    inputQty.value = qtyValue > 1 ? qtyValue - 1 : qtyValue;
                    break;
            
                default:
                    inputQty       = btnQty.previousElementSibling;
                    qtyValue       = parseInt(inputQty.value);
                    inputQty.value = qtyValue + 1;
                    break;
            }

            inputQty.dispatchEvent(new Event('change'));
        })
    })
}

// MARK: Loader
export function showLoader() { 
    const loader = document.querySelector('#page-loader');
    if (! loader) return;

    return loader.classList.remove('hidden');
}

export function hideLoader() { 
    const loader = document.querySelector('#page-loader');
    if (! loader) return;

    return loader.classList.add('hidden');
}

// MARK: Create new element
/**
 * Convert from html string to node element
 * 
 * @param {string} parentTag   - string
 * @param {array}  parentClass - array
 * @param {string} innerBody   - string
 */
export function createNewElement({parentTag = 'div', parentClass = [], innerBody = ''}) {
    const newHtmlObject = document.createElement(parentTag);

    newHtmlObject.classList.add(...parentClass);
    newHtmlObject.innerHTML = innerBody;

    return newHtmlObject;
}

window.createNewElement = createNewElement;

// MARK: Button table no content
/**
 * Trigger click event to button modal create data. 
 */
export function tableNoContentBtn() {
    const btnNoContent = document.querySelector('[data-no-content]');
    if (! btnNoContent) return;

    btnNoContent.addEventListener('click', () => document.querySelector('button[data-target-modal]').click())
}
// MARK: Button table new content
/**
 * Create new button trigger func load new data if detect new data created
 */
export function tableHasNewEntries(colspan) { 
    const tableDataElement  = document.querySelector('section[data-section="data-table-wrapper"] tbody');
    const btnLoadNewEntries = 
        `<td class="border-b py-2 px-3 bg-light-gray-50 text-center" colspan="${colspan}">
            <div wire:loading>Loading...</div>
            <button class="mx-auto block text-sm text-secondary hover:underline" wire:click="loadContent" wire:loading.remove>Muat Konten Baru</button>
        </td>`;

    const elLoadNewEntries = createNewElement({
        parentTag: 'tr', 
        innerBody: btnLoadNewEntries
    });
    
    tableDataElement.prepend(elLoadNewEntries);
}

// MARK: Tooltip
/**
 * Tooltip class instance.
 * 
 * @param targetEl    - Popup element
 * @param triggerEl   - Hover element
 * @param placementEl - Placement popup tooltip
*/
class Tooltip {
    /**
     * @param {object} targetEl
     * @param {object} triggerEl
     * @param {string} placementEl
    */
    constructor(targetEl, triggerEl, placementEl) {
        this.targetEl    = targetEl;
        this.triggerEl   = triggerEl;
        this.placementEl = placementEl;
        this.init();
    }

    /**
     * Initializes the Tooltip instance by setting up event listeners and attributes
     * if the trigger element exists.
    */
    init() {
        if (this.triggerEl) {
            this.setupEventListeners();
            this.setupAttribute();
        }
    }

    /**
     * Sets up event listeners for the tooltip.
     * 
     * This function adds event listeners for the 'mouseenter' and 'mouseleave' events on the trigger element.
     * When the 'mouseenter' event is triggered, the 'show' method is called to display the tooltip.
     * When the 'mouseleave' event is triggered, the 'hide' method is called to hide the tooltip.
    */
    setupEventListeners() {
        this.handleStyle();
        this.triggerEl.addEventListener('mouseenter', () => this.show());
        this.triggerEl.addEventListener('mouseleave', () => this.hide());
    }

    /**
     * Handles the style of the tooltip arrow element.
     *
     * This function sets up the style for the tooltip arrow element by querying
     * the DOM for the '.tooltip-arrow' class and then calling the
     * 'setupStyleElement' and 'setupStyleArrow' methods to set up the style.
    */
    handleStyle() {
        const arrowEl = this.targetEl.querySelector('.tooltip-arrow');

        this.setupStyleElement(arrowEl);
        this.setupStyleArrow(arrowEl);
    }

    /**
     * Sets the 'data-popper-placement' attribute on the target element to the value of the 'placementEl' property.
    */
    setupAttribute() {
        this.targetEl.setAttribute('data-popper-placement', this.placementEl);
    }

    /**
     * Sets up the style for the tooltip element and calculates the position of the tooltip arrow.
     *
     * @param {object} arrowEl - The tooltip arrow element.
     */
    setupStyleElement(arrowEl) {
        const hasSidebar   = document.querySelector('[data-element="sidebar"]');
        const sidebarWidth = hasSidebar ? hasSidebar.getBoundingClientRect().width : 0;
        const triggerPos   = this.triggerEl.getBoundingClientRect();
        const offsetX      = this.targetEl.getAttribute('data-tooltip-offset-x') ?? 0;
        const offsetY      = this.targetEl.getAttribute('data-tooltip-offset-y') ?? 0;
        const arrowHeight  = arrowEl?.offsetHeight ?? 0;
        const translateX   = triggerPos.left - sidebarWidth + ((triggerPos.width - this.targetEl.offsetWidth) / 2) + parseInt(offsetX);
        const translateY   = triggerPos.top + triggerPos.height + parseInt(offsetY) + arrowHeight;

        this.targetEl.style.position  = 'absolute';
        this.targetEl.style.inset     = '0px auto auto 0px';
        this.targetEl.style.margin    = '0px';
        this.targetEl.style.transform = `translate3d(${translateX}px, ${translateY}px, 0px)`;
    };

    /**
     * Sets up the position for the tooltip arrow element.
     *
     * @param {object} arrowEl - The tooltip arrow element.
    */
    setupStyleArrow(arrowEl) {
        if (! arrowEl) return;
        const offsetX    = this.targetEl.getAttribute('data-arrow-offset-x') ?? 0;
        const translateX = (this.targetEl.offsetWidth / 2) - (arrowEl.offsetWidth / 2) + parseInt(offsetX);
        
        arrowEl.style.position  = 'absolute';
        arrowEl.style.left      = '0px';
        arrowEl.style.transform = `translate3d(${translateX}px, 0px, 0px)`;
    };

    /**
     * Show the tooltip.
    */
    show() {
        this.handleStyle();
        this.targetEl.classList.remove('opacity-0', 'invisible');
        this.targetEl.classList.add('opacity-100', 'visible');
    };

    /**
     * Hide the tooltip.
    */
    hide() {
        this.targetEl.classList.remove('opacity-100', 'visible');
        this.targetEl.classList.add('opacity-0', 'invisible');
    };
}

export function initTooltips() { 
    document.querySelectorAll('[data-tooltip-target]').forEach(function(triggerEl) {
        const dataTarget = triggerEl.getAttribute('data-tooltip-target');
        const tooltipEl  = document.querySelector(`[data-tooltip-trigger="${dataTarget}"]`);

        new Tooltip(tooltipEl, triggerEl, 'bottom');
    });
};

// TODO: Move to admin js
//MARK: Simple image uploader
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
            imageUrl:  URL.createObjectURL(this.imageFile),
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
        const uploadedImgWrapper    = document.querySelector('div[data-image-target]');
        const iconImgBtn            = document.querySelector('button[data-image-trigger] img');
        const imgNameClasses        = 'text-sm text-secondary font-bold line-clamp-1';
        const imgNameInvalidClasses = 'text-[10px] font-light';
        const imgSizeClasses        = 'text-[10px] font-light';
        const imgSizeInvalidClasses = 'text-sm text-red-600 font-bold';

        this.shrinkBtnTrigger();

        setTimeout(() => {
            const content = `
                <img class="p-1 h-9 rounded-lg" src="${imageUrl}">
                <div class="h-9 leading-4">
                    <div class="${isInvalid ? imgNameInvalidClasses : imgNameClasses}" title="${imageName}">${imageName}</div>
                    <div class="${isInvalid ? imgSizeInvalidClasses : imgSizeClasses}">${imageSize} KB ${isInvalid && ' - Invalid Size! (>500KB)'}</div>
                </div>
            `;
            
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

// MARK: Invalid form Select2
/**
 * Change border color if invalid validation 
*/
export function initInvalidSelect2() { 
    const errorSelect = document.querySelectorAll('select[id^=form-select].is-invalid');

    errorSelect.forEach(el => {
        const s2Target  = el.nextSibling;
        const s2Wrapper = s2Target.querySelector('.select2-selection');

        s2Wrapper.style.borderColor = '#dc2626';
    });
}

// MARK: Accordion
/**
 * Class for handling accordion element.
*/
export class Accordion {
    /**
     * Toggle the accordion state.
     * 
     * @param {Object}  opt                 - Options object
     * @param {boolean} opt.isHide          - Indicates whether the accordion element target has the 'hide' class
     * @param {string}  opt.hideClass       - Name of 'hide' class
     * @param {object}  opt.targetEl        - The accordion element target
     * @param {object}  opt.wrapperEl       - The element that wraps the target element
     * @param {string}  opt.additionalClass - Additional classes want to add to wrapper class
    */
    toogleAccordion({isHide, hideClass = 'hide', targetEl, wrapperEl, additionalClass = 'active'}) { 
        if (isHide) {
            targetEl.classList.remove(hideClass);
            wrapperEl.classList.add(additionalClass);
        } else {
            targetEl.classList.add(hideClass);
            wrapperEl.classList.remove(additionalClass);
        }
    };
}