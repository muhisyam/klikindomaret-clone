headerCategory();

function headerCategory() {
    const btnCategory = document.querySelector('.bottom-section .category');
    const bottomHeaderWrapper = document.querySelector('.header .bottom-header .header-wrapper');
    
    function toggleCategoryButton() {
        const bottomHeader = document.querySelector('.header .bottom-header');
        const isWrapperHidden = bottomHeader.classList.contains('hidden');
        
        if (isWrapperHidden) {
            bottomHeader.classList.remove('hidden');
            bottomHeader.querySelector('.header-overlay').classList.remove('hidden');
        } else {
            bottomHeader.classList.add('hidden');
            bottomHeader.querySelector('.header-overlay').classList.add('hidden');
        }
    }
    
    btnCategory.addEventListener('click', function () { 
        toggleCategoryButton();
    });
    
    bottomHeaderWrapper.addEventListener('mouseleave', function () { 
        toggleCategoryButton();
    });
    
}
