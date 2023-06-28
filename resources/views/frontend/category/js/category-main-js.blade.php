<script>
    // Product Promo section
    const productPromoSwiper = new Swiper('.category-section-content .list-category-product', {
        slidesPerView: 6,
        slidesPerGroup: 2,
        spaceBetween: 20,
        navigation: {
            nextEl: "#promo-product-category-next",
            prevEl: "#promo-product-category-prev"
        }
    });

    const btnCopyCoupon = document.querySelector('.copy-code');

    btnCopyCoupon.addEventListener('click', function () {
        const couponCode = document.querySelector('.coupon-code .code span').innerHTML;
        const iconCopy = document.querySelector('#copy-code');
        const iconCopied = document.querySelector('#copied-code');

        navigator.clipboard.writeText(couponCode);
        iconCopy.classList.add('hidden');
        iconCopied.classList.remove('hidden');
        btnCopyCoupon.classList.remove('bg-white');
    });

    const accordListBtn = document.querySelectorAll('.accordion-filter-heading button');
    const arrayAccordList = [].slice.call(accordListBtn);
    
    arrayAccordList.map((accordList) => {
        accordList.addEventListener('click', function () {
            const accordDataTarget = accordList.getAttribute('data-accordion-target');
            const accordTarget = document.querySelector(accordDataTarget);
            const isTargetHide = accordTarget.classList.contains('hide');

            if (isTargetHide) {
                accordTarget.classList.remove('hide');
                accordList.classList.add('active');
            } else {
                accordTarget.classList.add('hide');
                accordList.classList.remove('active');
            }
        });
    });

    const inputSearchFilter = document.querySelector('#text-search-filter');

    inputSearchFilter.addEventListener('input', function () {
        const searchIcon = document.querySelector('.search-filter-wrapper .search-icon');
        const clearIcon = document.querySelector('.search-filter-wrapper .clear-icon');

        if (inputSearchFilter.value) {
            searchIcon.classList.add('hidden');
            clearIcon.classList.remove('hidden');
        } else {
            searchIcon.classList.remove('hidden');
            clearIcon.classList.add('hidden');
        }
    });

    const btnSelectFilter = document.querySelector('.select-filter-wrapper');

    btnSelectFilter.addEventListener('click', function () {
        const selectBox = document.querySelector('.select-box');
        const selectOption = document.querySelector('.select-option');
        const listOption = document.querySelector('.list-option');
        const isSelectHidden = selectOption.classList.contains('hidden');

        if (isSelectHidden) {
            btnSelectFilter.classList.add('active');
            selectBox.classList.remove('rounded');
            selectBox.classList.add('rounded-t');
            selectBox.classList.add('border-b-0');
            listOption.classList.add('border-t-0');
            selectOption.classList.toggle('hidden');
        } else {
            btnSelectFilter.classList.remove('active');
            selectBox.classList.add('rounded');
            selectBox.classList.remove('rounded-t');
            selectBox.classList.remove('border-b-0');
            listOption.classList.remove('border-t-0');
            selectOption.classList.toggle('hidden');
        }
    });

    const tabButtonHeading = document.querySelectorAll('.category .right-side .item-tab');
    const arrayTabButton = [].slice.call(tabButtonHeading);

    arrayTabButton.map((menuTab) => {
        menuTab.addEventListener('click', function () {
            const allPanelTab = document.querySelector('.list-panel').children;
            const arrayPanelTab = [].slice.call(allPanelTab);
            
            arrayTabButton.map((menuTab) => {
                menuTab.classList.remove('active');
            });
            
            arrayPanelTab.map((panelTab) => {
                panelTab.classList.add('hidden');
            });

            const panelDataTarget = menuTab.getAttribute('data-tab-target');
            const panelTarget = document.querySelector(panelDataTarget);
            const isPanelHidden = panelTarget.classList.contains('hidden');
            
            if (isPanelHidden) {
                menuTab.classList.add('active');
                panelTarget.classList.remove('hidden');
            }
        }); 
    });

</script>