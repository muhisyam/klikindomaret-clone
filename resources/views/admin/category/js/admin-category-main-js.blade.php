<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Jquery just for convert purpose(✌ ͡• ₃ ͡•)✌
        $('#form-select-level').select2({
            width: '100%',
            placeholder: 'Pilih Level...',
        });

        $('#form-select-parent').select2({
            width: '100%',
            placeholder: 'Pilih Induk...',
        });

        $('#form-select-status').select2({
            width: '100%',
        });
        // Thanks for the tolerance(👍 ͡• ₃ ͡•)👍


        const errorSelect = document.querySelectorAll('select[id^=form-select].is-invalid');
    
        errorSelect.forEach(el => {
            const s2Target = el.nextSibling;
            const s2wrapper = s2Target.querySelector('.select2-selection');

            s2wrapper.style.borderColor = '#dc2626';
        });
    });

    function hideAccordContent(e, curr) { 
        e.forEach(listContent => {
            const listId = listContent.id;
            return listId !== curr ? listContent.classList.add('hide') : '';
        });
    }

    function activateButtonAccord(e, curr) { 
        e.forEach(btnItem => {
            const btnAttribute = btnItem.getAttribute('data-accordion-target');
            return btnAttribute !== curr ? btnItem.classList.remove('active') : '';
        });
    }

    function toogleAccordion(isHide, elContent, elBtn) { 
        if (isHide) {
            elContent.classList.remove('hide');
            elBtn.classList.add('active');
        } else {
            elContent.classList.add('hide');
            elBtn.classList.remove('active');
        }
    }

    function ariaHiddenToogle(e) { 
        e.forEach(element => {
            const isActive = element.classList.contains('hide');
            return element.setAttribute('aria-hidden', !isActive);
        });
    }

    function ariaExpandedToogle(e) { 
        e.forEach(element => {
            const isActive = element.classList.contains('active');

            if (element.tagName.toLowerCase() != 'button') {
                const elementButton = element.querySelector('.accordion-category-button button');
                return elementButton.setAttribute('aria-expanded', isActive);
            }

            return element.setAttribute('aria-expanded', isActive);
        });
    }

    // List subcategory page
    const listSubCategoryRow = document.querySelectorAll('.accordion-category-item');

    listSubCategoryRow.forEach(subCategory => {
        const subCategoryBtn = subCategory.querySelector('.accordion-category-button button');

        subCategoryBtn.addEventListener('click', function () {
            const listAccordContent = document.querySelectorAll('.accordion-category-wrapper');
            const accordDataTarget = subCategoryBtn.getAttribute('data-accordion-target');
            const accordTarget = document.querySelector(`#${accordDataTarget}`);
            const isTargetHide = accordTarget.classList.contains('hide');

            toogleAccordion(isTargetHide, accordTarget, subCategory);
            ariaExpandedToogle(listSubCategoryRow);
            ariaHiddenToogle(listAccordContent);

        });
    });

    // Input subcategory page
    const listSubCategoryBtn = document.querySelectorAll('.accordion-category-heading button');

    listSubCategoryBtn.forEach(subCategoryBtn => {
        subCategoryBtn.addEventListener('click', function () {
            const listAccordSubCategory = document.querySelectorAll('.accordion-category-content');
            const accordDataTarget = subCategoryBtn.getAttribute('data-accordion-target');
            const accordTarget = document.querySelector(`#${accordDataTarget}`);
            const isTargetHide = accordTarget.classList.contains('hide');

            hideAccordContent(listAccordSubCategory, accordDataTarget)
            activateButtonAccord(listSubCategoryBtn, accordDataTarget);
            toogleAccordion(isTargetHide, accordTarget, subCategoryBtn);
            ariaExpandedToogle(listSubCategoryBtn);
            ariaHiddenToogle(listAccordSubCategory);
        });
    });
</script>