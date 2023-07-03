<script>
    function toggleModal(element, dataAtribute) {
        const modalDataTarget = element.getAttribute(dataAtribute);
        const modalTarget = document.querySelector(modalDataTarget);

        modalTarget.classList.toggle('show');
        modalOverlay.classList.toggle('hidden');
    }
    
    let modalShowing;
    
    function openModal(element) {
        let modalElementAttribute;
        const dataButtonRole = element.getAttribute('data-button-role');
        
        modalShowing = element;
        
        if (dataButtonRole == 'open-modal' || dataButtonRole == 'delete-product' ) {
            if (dataButtonRole == 'delete-product') {
                const dataProductName = element.getAttribute('data-product-name');
                const modalProductName = document.querySelector('.item-modal .product-name span');
                
                modalProductName.innerText = dataProductName;
            };
            
            modalElementAttribute = 'data-modal-target';

        } else if (dataButtonRole == 'hide-modal') {
            modalElementAttribute = 'data-modal-hide';
        } 

        toggleModal(modalShowing, modalElementAttribute);
    };

    const modalOverlay = document.querySelector('.modal-overlay');

    modalOverlay.addEventListener('click', function () {
        toggleModal(modalShowing, 'data-modal-target');
    });
</script>