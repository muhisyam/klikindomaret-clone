<script>
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
</script>