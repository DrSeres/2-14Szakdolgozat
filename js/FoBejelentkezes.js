const loginsec=document.querySelector('.login-section')
const loginlink=document.querySelector('.login-link')
const registerlink=document.querySelector('.register-link')
const reggomb=document.getElementById('re')
const logingomb=document.getElementById('be')


registerlink.addEventListener('click',()=>{
    loginsec.classList.add('active')
})
loginlink.addEventListener('click',()=>{
    loginsec.classList.remove('active')
})


function fetchError(c, formId) {
    var formData = [];

    if(formId == 'reg-form' ) {
        console.log('reg-form');
        formData["name"] = document.getElementById('name').value;
        formData["email"] = document.getElementById('reg-email').value;
        formData["password"] = document.getElementById('reg-password').value;
        formData["passwordAgain"] = document.getElementById('passwordAgain').value;
    } else if (formId == 'login-form') {
        console.log('login-form');
        formData["email"] = document.getElementById('login-email').value;
        formData["password"] = document.getElementById('login-password').value;     
    }
    console.log(formData);

    fetch('../Webshop/api.php', {
        method: 'post',
        headers: {'Content-Type': 'application/json'},        
        body: JSON.stringify({
            'c': c,
            'formData': formData,
        })
      })
        .then((response) => response.json())
        .then((data) => {
          console.log(data);

          if(data.message == '') {
            //document.getElementById(formId).submit();
        } else {
            document.getElementById('#error-message').innerHTML(data.message);
        }
      })
        .catch((error) => console.log(error));
}

reggomb.addEventListener('click',(e)=>{
    fetchError('regisztracioValidalas', 'reg-form');
})


logingomb.addEventListener('click',(e)=>{
    fetchError('loginValidalas', 'login-form');
})
