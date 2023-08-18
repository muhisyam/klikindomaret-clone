function findButton(el) {
    const tagName = el.tagName.toLowerCase();
    
    if (tagName == 'button') {
        return el;
    } else {
        return findButton(el.parentElement);
    }
}

const menuWrapper = document.querySelectorAll('.sidebar .menu-wrapper');

menuWrapper.forEach(menu => {
    const accordButtonMenu = menu.querySelector('.accordion-menu-heading button');
    
    if (accordButtonMenu) {
        let dataOpenedMenu = '';
        accordButtonMenu.addEventListener('click', function(e) {
            const listAccordMenuContent = document.querySelectorAll('.sidebar .accordion-menu-content');
            const accordionMenuContent = menu.querySelector('.accordion-menu-content');  
            const accordButtonMenuList = document.querySelectorAll('.accordion-menu-heading button');

            listAccordMenuContent.forEach(list => {
                const listId = list.id;

                return listId !== dataOpenedMenu ? list.classList.add('hide') : '';
            });
            
            accordButtonMenuList.forEach(btn => {
                const btnAttribute = btn.getAttribute('data-menu-target');

                return btnAttribute !== dataOpenedMenu ? btn.classList.remove('active') : '';
            });

            accordionMenuContent.classList.toggle('hide');
            findButton(e.target).classList.toggle('active');
            
            dataOpenedMenu = findButton(e.target).getAttribute('data-menu-target');
        }); 
    };
});
  
