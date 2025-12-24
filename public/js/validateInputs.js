// const d = document;
document.addEventListener('DOMContentLoaded', e => {
    validateInputs('.profile_form [required]');
    validateInputs('form [required]');
})
 
 function validateInputs(form){
    const mainInput = document.querySelectorAll(form) ;
    mainInput.forEach(input => {
        const span = document.createElement('span');
        span.id = input.name;
        span.textContent = input.title;
        span.classList.add('input_error', 'hide' );
        input.insertAdjacentElement('afterend', span);
    });

    document.addEventListener('keyup', e => {
        if(e.target.matches(form)){
            const targetSpan = document.getElementById(e.target.name);
            let pattern = e.target.pattern;
            if(pattern){
                let regExp = new RegExp(pattern);
                return !regExp.exec(e.target.value)
                 ? targetSpan.classList.remove('hide')
                 : targetSpan.classList.add('hide');
            }
        }
    })
}




   




