<script>
    const formTooltipTarget = document.querySelectorAll('.user-info [data-tooltip-target]');
    
    formTooltipTarget.forEach(element => {
        const formLabel = element.parentElement.children[0].innerText;
        const tooltipWrapper = element.parentElement.children[3];
        const tooptipInfo = tooltipWrapper.querySelector('.tooltip-text').innerText += `Ubah ${formLabel}`;        
    });
</script>