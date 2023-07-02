<script>
    function toggleModal(buttonModal, dataAtribute) { 
        const modalDataTarget = buttonModal.getAttribute(dataAtribute);
        const modalTarget = document.querySelector(modalDataTarget);

        modalTarget.classList.toggle('show');
        modalOverlay.classList.toggle('hidden');
    }

    const modalOverlay = document.querySelector('.modal-overlay');
    const btnFreeShipping = document.querySelector('.btn-free-shipping');
    
    btnFreeShipping.addEventListener('click', function () {
        toggleModal(btnFreeShipping, 'data-modal-target');
    });

    const btnCloseModal = document.querySelector('.button-close-modal button');

    btnCloseModal.addEventListener('click', function () {
        toggleModal(btnCloseModal, 'data-modal-hide');
    });

    modalOverlay.addEventListener('click', function () {
        toggleModal(btnFreeShipping, 'data-modal-target');
    });
</script>