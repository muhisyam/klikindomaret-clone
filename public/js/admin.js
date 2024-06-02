import * as component from './components.js';

function findButton(e) {
    const tagName = e.tagName.toLowerCase();
    
    if (tagName == 'button') {
        return e;
    } else {
        return findButton(e.parentElement);
    }
}

function hideAccordContent(e, curr) { 
    e.forEach(listContent => {
        const listId = listContent.id;
        return listId !== curr ? listContent.classList.add('hide') : '';
    });
}

function activateButtonAccord(e, curr) { 
    e.forEach(btnItem => {
        const btnAttribute = btnItem.getAttribute('data-menu-target');
        return btnAttribute !== curr ? btnItem.classList.remove('active') : '';
    });
}

function ariaHiddenToogle(e) { 
    e.forEach(element => {
        const isActive = element.classList.contains('hide');
        return element.setAttribute('aria-hidden', isActive);
    });
}

function ariaExpandedToogle(e) { 
    e.forEach(element => {
        const isActive = element.classList.contains('active');
        return element.setAttribute('aria-expanded', isActive);
    });
}

const listMenuWrapper = document.querySelectorAll('.sidebar .menu-wrapper');

listMenuWrapper.forEach(menu => {
    const accordButtonMenu = menu.querySelector('.accordion-menu-heading button');
    
    if (accordButtonMenu) {
        let dataOpenedMenu = '';
        accordButtonMenu.addEventListener('click', function(e) {
            const listAccordMenu = document.querySelectorAll('.sidebar .accordion-menu-content');
            const listAccordButtonMenu = document.querySelectorAll('.accordion-menu-heading button');
            const accordMenuContent = menu.querySelector('.accordion-menu-content');  
            
            hideAccordContent(listAccordMenu, dataOpenedMenu);
            activateButtonAccord(listAccordButtonMenu, dataOpenedMenu);
            
            accordMenuContent.classList.toggle('hide');
            findButton(e.target).classList.toggle('active');

            dataOpenedMenu = findButton(e.target).getAttribute('data-menu-target');
            
            ariaExpandedToogle(listAccordButtonMenu);
            ariaHiddenToogle(listAccordMenu);
        }); 
    };
});

const greetingBodyWrapper = document.querySelector('.greeting .body');
let greetingText, notificationElement, timerNotificationBar, timeLeft, interval;
let totalTime = 5;


function showNotification(title, message) {
    const isLongText = message.length > 25 ? ' animation-running' : '';
    const notificationParentClass = ['action-notification', 'flex', 'items-center', 'animate__animated', 'animate__bounceInRight'];
    const timerClass = ['timer-notification', 'absolute', 'left-0', 'bottom-0', 'w-full', 'h-1', 'bg-secondary'];

    let notificationInner = `<div class="icon h-6 -ms-2 me-2"><i class="ri-delete-bin-6-fill"></i></div>
                            <div class="info flex items-center text-sm">
                                <h5 class="title capitalize me-1">${title}</h5>
                                <div class="desc max-w-[175px] font-bold whitespace-nowrap overflow-hidden">
                                    <p class="text relative${isLongText}" title="${message}">${message}</p>
                                </div>
                            </div>
                            <button type="button" onclick="closeNotification()" class="close h-6 rounded-md px-1 ms-2 -me-4 hover:bg-secondary hover:text-tertiary "><i class="ri-close-line"></i></button>`
                                
    if (!greetingText) {
        greetingText = document.querySelector('.greeting .greet-text');
        greetingText.classList.add('animate__animated', 'animate__bounceIn');
    }

    greetingText ? greetingText.remove() : '';
    notificationElement ? notificationElement.remove() : '';
    timerNotificationBar ? timerNotificationBar.remove() : '';
    
    notificationElement = toObjectHTML(notificationParentClass, notificationInner);
    timerNotificationBar = toObjectHTML(timerClass);

    greetingBodyWrapper.appendChild(notificationElement);
    greetingBodyWrapper.insertAdjacentElement("afterend", timerNotificationBar);
    
    clearInterval(interval);
    timeLeft = totalTime-1;

    return interval = setInterval(updateCountdown, 1000);
};

function closeNotification() {
    notificationElement ? notificationElement.remove() : '';
    timerNotificationBar ? timerNotificationBar.remove() : '';
    
    clearInterval(interval);

    return greetingBodyWrapper.appendChild(greetingText);
};

function updateProgressBar() {
    const percentage = (timeLeft / totalTime) * 100;
    timerNotificationBar.style.width = percentage + '%';
};

function updateCountdown() {
    updateProgressBar();

    timeLeft--;

    // Until the bar touch the end
    if (timeLeft < -1) {
        clearInterval(interval);

        notificationElement ? notificationElement.remove() : '';
        timerNotificationBar ? timerNotificationBar.remove() : '';

        return greetingBodyWrapper.appendChild(greetingText);
    }
};

component.toggleDropdown();
component.toggleModal();
component.hideOpenedComponentsFromOutside();
component.initTooltips();