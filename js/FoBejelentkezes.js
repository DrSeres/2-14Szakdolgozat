const loginsec=document.querySelector('.login-section')
const loginlink=document.querySelector('.login-link')
const registerlink=document.querySelector('.register-link')
const reggomb=document.getElementById('re')
const logingomb=document.getElementById('be')
const errorMessageDivInnerHtml = document.getElementById("error-message");    

//form váltások login-reg form váltás linkra
registerlink.addEventListener('click',()=>{
    errorMessageDivInnerHtml.innerHTML =  "";   
    loginsec.classList.add('active')
})
loginlink.addEventListener('click',()=>{
    errorMessageDivInnerHtml.innerHTML =  "";   
    loginsec.classList.remove('active')
})


function fetchError(c, formId) {

    const formResult = [];

    if(formId == 'reg-form' ) {    
        formResult.push(document.getElementById('name').value);
        formResult.push(document.getElementById('reg-email').value);
        formResult.push(document.getElementById('reg-password').value);
        formResult.push(document.getElementById('passwordAgain').value);
    } else if (formId == 'login-form') {
        formResult.push(document.getElementById('login-email').value);
        formResult.push(document.getElementById('login-password').value);     
    }
    
    fetch('../Webshop/api.php', {
        method: 'post',
        headers: {'Content-Type': 'application/json'},        
        body: JSON.stringify({
            'c': c,
            'formData': formResult,
        })
      })
        .then((response) => response.json())
        .then((data) => {
            if(data.message == '') {
                document.getElementById(formId).submit();
            } else {
                document.getElementById("error-message").innerHTML = data.message;
            }
      })
        .catch((error) => console.log(error));
}

//
reggomb.addEventListener('click',(e)=>{
    errorMessageDivInnerHtml.innerHTML =  "";   
    fetchError('regisztracioValidalas', 'reg-form');
})


logingomb.addEventListener('click',(e)=>{
    errorMessageDivInnerHtml.innerHTML =  "";
    fetchError('loginValidalas', 'login-form');
})
