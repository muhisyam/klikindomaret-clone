<script>
    function toggleModal(btn, dataAtribute) { 
        const modalDataTarget = btn.getAttribute(dataAtribute);
        const modalTarget = document.querySelector(modalDataTarget);

        modalTarget.classList.toggle('show');
        modalOverlay.classList.toggle('hidden');
    }

    let modalShowing;
    const modalOverlay = document.querySelector('.modal-overlay');
    const btnFreeShipping = document.querySelector('.btn-free-shipping');
    
    btnFreeShipping.addEventListener('click', function () {
        modalShowing = btnFreeShipping;
        
        toggleModal(btnFreeShipping, 'data-modal-target');
    });

    const btnDeleteProduct = document.querySelectorAll('.button-delete-product button');

    btnDeleteProduct.forEach(btnDelete => {
        btnDelete.addEventListener('click', function () {
            const dataProductName = btnDelete.getAttribute('data-product-name');
            const modalProductName = document.querySelector('.item-modal .product-name span');
            modalShowing = btnDelete;

            modalProductName.innerText = dataProductName;
            toggleModal(btnDelete, 'data-modal-target');
        });
    });

    const btnCloseModal = document.querySelectorAll('.button-close-modal button');

    btnCloseModal.forEach(btnClose => {
        btnClose.addEventListener('click', function () {
            toggleModal(btnClose, 'data-modal-hide');
        });
    });

    modalOverlay.addEventListener('click', function () {
        toggleModal(modalShowing, 'data-modal-target');
    });
</script>