<script>
    function toggleModal(element, dataAtribute) {
        console.log(element);
        const modalDataTarget = element.getAttribute(dataAtribute);
        const modalTarget = document.querySelector(modalDataTarget);

        modalTarget.classList.toggle('show');
        modalOverlay.classList.toggle('hidden');
    }
    
    function openModal(element) {  
        let modalElementAttribute;
        const modalShowing = element;
        const dataButtonRole = element.getAttribute('data-button-role');
        const isOverlay = element.classList.contains('.modal-overlay');
        
        if (!isOverlay) {
            const modalElementId = element.getAttribute('data-modal-target');
            
            modalOverlay.setAttribute('data-modal-target', modalElementId);
        };
        
        if (dataButtonRole == 'hide-modal') {
            modalElementAttribute = 'data-modal-hide';

        } else {
            if (dataButtonRole == 'delete-product') {
                const dataProductName = element.getAttribute('data-product-name');
                const modalProductName = document.querySelector('.item-modal .product-name span');
                
                modalProductName.innerText = dataProductName;
            };
            
            modalElementAttribute = 'data-modal-target';
        };

        toggleModal(modalShowing, modalElementAttribute);
    };

    const btnOpenModal = document.querySelectorAll('[data-modal-target]');
    const btnCloseModal = document.querySelectorAll('[data-modal-hide]');
    const modalOverlay = document.querySelector('.modal-overlay');

    const mergeBtnModal = [...btnOpenModal, ...btnCloseModal, modalOverlay];

    mergeBtnModal.forEach(element => {
        element.addEventListener('click', function () { 
            openModal(element);
        });
    });


    // modalOverlay.addEventListener('click', function () {
    //     toggleModal(modalShowing, 'data-modal-target');
    // });
</script>