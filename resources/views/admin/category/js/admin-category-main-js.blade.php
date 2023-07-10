<script>
    const accordListBtn = document.querySelectorAll('.accordion-category-heading button');

    accordListBtn.forEach (accordBtn => {
        accordBtn.addEventListener('click', function () {
            const allAccordContent = document.querySelectorAll('.accordion-category-content');

            allAccordContent.forEach (accordList => {
                accordList.classList.add('hide');
            });

            const accordDataTarget = accordBtn.getAttribute('data-accordion-target');
            const accordTarget = document.querySelector(`#${accordDataTarget}`);
            const isTargetHide = accordTarget.classList.contains('hide');

            
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