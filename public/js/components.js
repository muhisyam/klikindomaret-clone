function openModal(modal, overlay) {
    modal.classList.add('show');
    overlay.classList.remove('hidden');
}

function closeModal(modal) {
    modal.classList.remove('show');
    overlay.classList.add('hidden');
}