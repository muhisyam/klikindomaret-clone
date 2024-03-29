function toObjectHTML(elClass, elInner = null) {
    const newHtmlObject = document.createElement('div');

    newHtmlObject.classList.add(...elClass);
    
    if (elInner) {
        newHtmlObject.innerHTML = elInner;
    }

    return newHtmlObject;
}

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

const modalTarget = document.querySelector('.modal-delete');
const btnCloseTop = modalTarget.querySelector('#header-button-close');
const btnCloseBottom = modalTarget.querySelector('#footer-button-close');
const btnDeleteCategory = document.querySelectorAll('button.action-del');
const overlay = document.querySelector('#bg-overlay');

btnDeleteCategory.forEach(elBtn => {
    elBtn.addEventListener('click', function () {
        openModal(modalTarget, overlay);
    });
});

[btnCloseTop, btnCloseBottom, overlay].forEach(el => {
    el.addEventListener('click', () => closeModal(modalTarget, overlay));
});