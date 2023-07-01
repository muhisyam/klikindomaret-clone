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

    // Product per Section Collection section
    const productSectionCollection = new Swiper('.product-content .list-product', {
        slidesPerView: 7.5,
        slidesPerGroup: 3,
        spaceBetween: 20,
        navigation: {
            nextEl: "#product-section-id42141-next",
            prevEl: "#product-section-id42141-prev"
        }
    });

    const btnShare = document.querySelector('.product-info-wrapper .social-media-share button');
    
    btnShare.addEventListener('click', function () {
        const shareWrapper = document.querySelector('.product-info-wrapper .social-media-share .social-media-wrapper');
        return shareWrapper.classList.toggle('hidden');
    });
    
    const btnSubQty = document.querySelector('.detail-product #btn-min-qty');
    const btnAddQty = document.querySelector('.detail-product #btn-plus-qty');
    
    btnSubQty.addEventListener('click', function () {
        let inputQty = document.querySelector('.detail-product #input-qty');
        let valueInput = parseFloat(inputQty.value);
        
        if (valueInput != 1) {
            return inputQty.value = valueInput - 1;
        }
    });

    btnAddQty.addEventListener('click', function () {
        let inputQty = document.querySelector('.detail-product #input-qty');
        let valueInput = parseFloat(inputQty.value);
        
        return inputQty.value = valueInput + 1;
    });

    const btnExpandProductSpec = document.querySelector('.product-info-wrapper .product-spec-wrapper .button-expand-content');
    
    btnExpandProductSpec.addEventListener('click', function () {
        const productSpecificationWrapper = document.querySelector('.product-info-wrapper .product-spec-wrapper');
        return productSpecificationWrapper.classList.toggle('hide');
    });

    
</script>