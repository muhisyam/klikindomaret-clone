<script>
    convertRichText();

    function convertRichText() {
        const listTextarea = document.querySelectorAll('.item-input-group > #form-input-desc > #desc-info');
        listTextarea.forEach(el => {
            ClassicEditor
                .create( el )
                .catch( error => {
                    console.error( error );
                } );
        });
    };

    var currentTextareaId;

    function currTextarea() { 
        const listTextarea = document.querySelectorAll('[id^="addon"]');
        [...listTextarea].every((el, index) => {
            const isHidden = el.classList.contains('hidden');
            
            if (!isHidden) {
                currentTextareaId = 5;
                return true;
            } else {
                currentTextareaId = index;
                return false;
            }
        });
    }

    const btnAddDesc = document.querySelector('#btnAddDesc');
    const btnDelDesc = document.querySelector('#btnDelDesc');

    btnAddDesc.addEventListener('click', function() {
        currTextarea();

        const textareaTarget = document.querySelector(`#addon-${currentTextareaId+1}`);
        
        textareaTarget.classList.remove('hidden');
        btnDelDesc.classList.remove('hidden');

        if (currentTextareaId == 4) {
            btnAddDesc.classList.add('hidden');
        }
    });

    btnDelDesc.addEventListener('click', function() {
        currTextarea();
        const textareaTarget = document.querySelector(`#addon-${currentTextareaId}`);
       
        textareaTarget.classList.add('hidden');
        btnAddDesc.classList.remove('hidden');

        if (currentTextareaId == 2) {
            btnDelDesc.classList.add('hidden');
        }
        // hidden textare reset value
    });



</script>