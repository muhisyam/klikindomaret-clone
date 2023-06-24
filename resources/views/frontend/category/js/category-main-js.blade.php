<script>
    const accordBtn = document.querySelector('.accordion-filter-heading button');

    accordBtn.addEventListener('click', function () {
        const accordContent = document.querySelector('.accordion-filter-content');
        const isHide = accordContent.classList.contains('hide');
        
        if (isHide) {
            accordContent.classList.remove('hide');
            accordBtn.classList.add('active');
        } else {
            accordContent.classList.add('hide');
            accordBtn.classList.remove('active');
        }
    });

    // Product Promo section
    const productPromoSwiper = new Swiper('.category-section-content .list-product', {
        slidesPerView: 6,
        slidesPerGroup: 2,
        spaceBetween: 20,
        navigation: {
            nextEl: "#promo-product-category-next",
            prevEl: "#promo-product-category-prev"
        }
    });
</script>