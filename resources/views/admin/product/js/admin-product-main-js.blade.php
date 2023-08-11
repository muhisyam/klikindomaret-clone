<script>
    convertRichText();

    function convertRichText() {
        const listTextarea = document.querySelectorAll('.item-input-group > #form-input-desc > #desc-info');
        listTextarea.forEach(element => {
            ClassicEditor
                .create( element )
                .catch( error => {
                    console.error( error );
                } );
        });
    };

    let newDesc = `<div id="ada">sadsasadadsdsa</div>`;

    const formInputWrapper = document.querySelector('.right-side');
    const btnAddDesc = document.querySelector('#btnAddDesc');
    
    btnAddDesc.addEventListener('click', function() {
        formInputWrapper.appendChild();
    });
</script>