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

    function openSubcategoryWrapper(el) { 
        const dataElement = el.querySelectorAll('tbody tr');
        const dataLength = dataElement.length;

        const dataHeight = (dataLength - 1) * 48;

        el.style.maxHeight = dataHeight + 'px';
    }

    const subcategoryItem = document.querySelectorAll('.accordion-category-item');

    subcategoryItem.forEach(subItem => {
        const subButton = subItem.querySelector('.accordion-category-button button');

        subButton.addEventListener('click', function () {
            const accordDataTarget = subButton.getAttribute('data-accordion-target');
            const accordTarget = document.querySelector(`#${accordDataTarget}`);
            const isTargetHide = accordTarget.classList.contains('hide');

            if (isTargetHide) {
                accordTarget.classList.remove('hide');
                subItem.classList.add('active');
                openSubcategoryWrapper(accordTarget);
            } else {
                accordTarget.classList.add('hide');
                subItem.classList.remove('active');
                accordTarget.style.maxHeight = 0 + 'px';
            }
        });
    });

    const accordListBtn = document.querySelectorAll('.accordion-category-heading button');

    accordListBtn.forEach (accordBtn => {
        accordBtn.addEventListener('click', function () {
            const allAccordContent = document.querySelectorAll('.accordion-category-content');
            const accordDataTarget = accordBtn.getAttribute('data-accordion-target');
            const accordTarget = document.querySelector(`#${accordDataTarget}`);
            const isTargetHide = accordTarget.classList.contains('hide');
            
            allAccordContent.forEach (accordList => {
                const thisAccordContent = accordList.id;

                return accordDataTarget != thisAccordContent ? accordList.classList.add('hide') : '';
            });

            if (isTargetHide) {
                accordTarget.classList.remove('hide');
                accordBtn.classList.add('active');
            } else {
                accordTarget.classList.add('hide');
                accordBtn.classList.remove('active');
            }
        });
    });
</script>