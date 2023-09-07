document.addEventListener('DOMContentLoaded', function() {
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
});
    
function btnDataAction(e) {
    const actionTarget = e.getAttribute('data-target-action');
    const actionWrapper = document.querySelector(`#${actionTarget}`);

    return actionWrapper.classList.toggle('hidden');
    // TODO: ADD ACTIVE CLASS TO CHANGE ICON TO CLOSE ICON
}