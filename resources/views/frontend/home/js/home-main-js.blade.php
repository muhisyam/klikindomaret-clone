<script>
    // Swipper Hero section
    const heroSwiper = new Swiper('.list-heroes-banner', {
        slidesPerView: 1.317992,
        centeredSlides: true,
        loop: true,
        spaceBetween: 20,
        autoplay: {
            delay: 2000,
            pauseOnMouseEnter: true
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-heroes-next",
            prevEl: ".swiper-heroes-prev"
        },
    });

    // Swipper Channel section
    const channelSwiper = new Swiper('.list-channel', {
        slidesPerView: 12.5,
        spaceBetween: 20,
        preventClicks: true
    });

    // Swipper Promo section
    const promoSwiper = new Swiper('.list-promo', {
        slidesPerView: 2.5,
        spaceBetween: 20,
    });

    // Official Store section
    const storeSwiper = new Swiper('.list-store', {
        slidesPerView: 8,
        spaceBetween: 20,
    });

    // Flash Sale section
    const flashSwiper = new Swiper('.list-flash', {
        slidesPerView: 7,
        slidesPerGroup: 2,
        spaceBetween: 20,
        freeMode: true,
        navigation: {
            nextEl: ".swiper-flashsale-next",
            prevEl: ".swiper-flashsale-prev"
        }
    });

    // Product Promo section
    const productPromoSwiper = new Swiper('.product-promo .list-product', {
        slidesPerView: 7.5,
        slidesPerGroup: 3,
        spaceBetween: 20,
        navigation: {
            nextEl: "#promo-product-id42141-next",
            prevEl: "#promo-product-id42141-prev"
        }
    });

    const targetElement = document.querySelector('.list-flash .swiper-wrapper');
    const observer = new MutationObserver((mutationsList) => {
        for (const mutation of mutationsList) {
            if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
                // Check if the 'translate3d' property has changed
                const style = targetElement.style.transform;
                // Split string to array
                const getTranslate = style.replace('translate3d(', '').replace(')', '').replace('px', '').split(',');
                // Change css atribute on this element
                const flashThumbnail = document.querySelector('.flash-thumbnail-wrapper');
                const elementHide = flashThumbnail.classList.contains('hide');
                // If slider going to left, thumbnail disappear
                if (getTranslate[0] < -85 && !elementHide) {
                    flashThumbnail.classList.add('hide');
                } 
                // If slider going to first place, thumbnail appear
                if (getTranslate[0] > -85 && elementHide) {
                    flashThumbnail.classList.remove('hide');
                }
            }
        }
    });

    observer.observe(targetElement, { attributes: true });
</script>