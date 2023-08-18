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


    // List subcategory page
    const subCategoryItem = document.querySelectorAll('.accordion-category-item');

    subCategoryItem.forEach(subCategory => {
        const subCategoryButton = subCategory.querySelector('.accordion-category-button button');

        subCategoryButton.addEventListener('click', function () {
            const accordDataTarget = subCategoryButton.getAttribute('data-accordion-target');
            const accordTarget = document.querySelector(`#${accordDataTarget}`);
            const isTargetHide = accordTarget.classList.contains('hide');

            if (isTargetHide) {
                accordTarget.classList.remove('hide');
                subCategory.classList.add('active');
            } else {
                accordTarget.classList.add('hide');
                subCategory.classList.remove('active');
            }
        });
    });


    // Input subcategory page
    const subCategoryButton = document.querySelectorAll('.accordion-category-heading button');

    subCategoryButton.forEach (subCategoryButton => {
        subCategoryButton.addEventListener('click', function () {
            const allAccordSubCategory = document.querySelectorAll('.accordion-category-content');
            const accordDataTarget = subCategoryButton.getAttribute('data-accordion-target');
            const accordTarget = document.querySelector(`#${accordDataTarget}`);
            const isTargetHide = accordTarget.classList.contains('hide');
            
            allAccordSubCategory.forEach (accordSubCategory => {
                const thisAccordContent = accordSubCategory.id;

                return accordDataTarget != thisAccordContent ? accordSubCategory.classList.add('hide') : '';
            });

            if (isTargetHide) {
                accordTarget.classList.remove('hide');
                subCategoryButton.classList.add('active');
            } else {
                accordTarget.classList.add('hide');
                subCategoryButton.classList.remove('active');
            }
        });
    });
</script>