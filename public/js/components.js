function openModal(modal, overlay) {
    modal.classList.contains('show') ? '' : modal.classList.add('show');
    overlay.classList.remove('hidden');
}

function closeModal(modal) {
    modal.classList.contains('show') ? modal.classList.remove('show') :'';
    overlay.classList.add('hidden');
}