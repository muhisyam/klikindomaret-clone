<script>
    // Image Thumbnail section
    const productPromoSwiper = new Swiper('.product-thumbnail .list-thumbnail', {
        slidesPerView: 4,
        slidesPerGroup: 1,
        spaceBetween: 16,
        // navigation: {
        //     nextEl: "#promo-product-category-next",
        //     prevEl: "#promo-product-category-prev"
        // }
    });

    const btnShare = document.querySelector('.product-info-wrapper .social-media-share button');
    
    btnShare.addEventListener('click', function () {
        const shareWrapper = document.querySelector('.product-info-wrapper .social-media-share .social-media-wrapper');
        return shareWrapper.classList.toggle('hidden');
    });
    
    const btnExpandProductSpec = document.querySelector('.product-info-wrapper .product-spec-wrapper .button-expand-content');
    
    btnExpandProductSpec.addEventListener('click', function () {
        const productSpecificationWrapper = document.querySelector('.product-info-wrapper .product-spec-wrapper');
        return productSpecificationWrapper.classList.toggle('hide');
    });

    
</script>