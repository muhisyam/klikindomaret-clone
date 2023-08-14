// headerCategory();
openLoginRegis();

function openLoginRegis() {
    const btnLogin = document.querySelector('#btn-login');

    btnLogin.addEventListener('click', (e) => {
        const loginElement = document.querySelector('.login');
        const overlay = document.querySelector('#bg-overlay');
        
        loginElement.classList.toggle('show');
        overlay.classList.toggle('hidden');
    });
}

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
        document.querySelector('.item-menu-category').classList.add('active');
        document.querySelector('.list-category-wrapper').classList.remove('hidden');
        document.querySelector('.item-sub-level-1').classList.add('active');
        document.querySelector('.subcategory-header img').src = "https://assets.klikindomaret.com///products/banner/15-Icon-Makanan-R1.png";
        document.querySelector('.subcategory-header span').textContent = "Makanan";
        document.querySelector('.subcategory-level-2').classList.remove('hidden');
    });
    
    bottomHeaderWrapper.addEventListener('mouseleave', function () { 
        toggleCategoryButton();
        
        arrayItemMenu.map((linkMenu) => {
            return linkMenu.classList.remove('active');
        });

        arrayListCategory.map((categoryContent) => {
            return categoryContent.classList.add('hidden');
        });

        arraySubLevel1.map((subLevel1) => {
            return subLevel1.classList.remove('active');
        });
    });
    
    const categoryAllItemMenu = document.querySelectorAll('.header .bottom-header .top-section .item-menu-category');
    const categoryAllListCategory = document.querySelectorAll('.header .bottom-header .bottom-section .list-category-wrapper');
    const arrayItemMenu = [].slice.call(categoryAllItemMenu);
    const arrayListCategory = [].slice.call(categoryAllListCategory);
    
    arrayItemMenu.map((linkMenu) => {
        linkMenu.addEventListener('mouseenter', function () { 
            const menuAttribute = this.querySelector('a').getAttribute('data-menu-name').toLowerCase()

            arrayItemMenu.map((linkMenu) => { 
                linkMenu.classList.remove('active');
            });

            arrayListCategory.map((linkCategory) => { 
                const isCategoryHidden = linkCategory.classList.contains('hidden');
                return !isCategoryHidden ? linkCategory.classList.add('hidden') : '';
            });

            this.classList.add('active');
            document.querySelector('#category-' + menuAttribute).classList.remove('hidden');
        });
    });
    
    const subcategoryAllLevel1 = document.querySelectorAll('.header .bottom-header .bottom-section .left-side .item-sub-level-1');
    const subcategoryAllLevel2 = document.querySelectorAll('.header .bottom-header .bottom-section .right-side .subcategory-level-2');
    const arraySubLevel1 = [].slice.call(subcategoryAllLevel1);
    const arraySubLevel2 = [].slice.call(subcategoryAllLevel2);

    arraySubLevel1.map((subLevel1) => {
        subLevel1.addEventListener('mouseenter', function () { 
            const idCategory = this.getAttribute('data-category-id');
            const nameCategory = this.getAttribute('data-category-name');
            const imageCategory = this.getAttribute('data-category-image');
            

            arraySubLevel1.map((subLevel1) => {
                subLevel1.classList.remove('active');
            });
            
            arraySubLevel2.map((subLevel2) => {
                const subcategoryHeader = document.querySelector('.header .bottom-header .bottom-section .right-side .header-wrapper');
                const isSubcategory = subLevel2.classList.contains('subcategory-' + idCategory);
                
                subLevel2.classList.add('hidden');

                if (isSubcategory) {
                    subcategoryHeader.querySelector('img').src = imageCategory;
                    subcategoryHeader.querySelector('span').textContent = nameCategory;
                    subLevel2.classList.remove('hidden');
                }
                
                subLevel1.classList.add('active');
            });
        });
    });
}
