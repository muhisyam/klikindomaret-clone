function openAccordMenu(element) { 
    const listSubmenu = element.querySelector('.list-submenu');
    const itemSubmenu = listSubmenu.querySelectorAll('.item-submenu');
    const itemLength = itemSubmenu.length;
    const listHeight = (itemLength * 40) + ((itemLength - 1) * 4); // height each item + gap 4px
   
    element.style.maxHeight = listHeight + 'px';
}

const menuWrapper = document.querySelectorAll('.sidebar .menu-wrapper');

menuWrapper.forEach(menu => {
    const accordButtonMenu = menu.querySelector('.accordion-menu-heading button');
    
    if (accordButtonMenu) {
        accordButtonMenu.addEventListener('click', function() { 
            const listAccordMenuContent = document.querySelectorAll('.sidebar .menu-wrapper .accordion-menu-content');

            listAccordMenuContent.forEach(list => {
                list.classList.add('hide');
                list.style.maxHeight = 0 + 'px';
            });

            const accordionMenuContent = menu.querySelector('.accordion-menu-content');   
            
            accordionMenuContent.classList.remove('hide');
            openAccordMenu(accordionMenuContent);
        }); 
    };
});