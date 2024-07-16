const imgShowPss = document.querySelector('#show_pss');
const formNewAccount = document.forms['form_new_account'];

function showPss(){
    formNewAccount.password.type = 'input';
    formNewAccount.password_confirm.type = 'input';
}

imgShowPss.addEventListener('mousedown', showPss);

function hidePss(){
    formNewAccount.password.type = 'password';
    formNewAccount.password_confirm.type = 'password';
}

imgShowPss.addEventListener('mouseup', hidePss);


function printSentence(inputElement, message, class_){
    if (inputElement.nextElementSibling.classList.contains('error') || inputElement.nextElementSibling.classList.contains('right')) {
        inputElement.nextElementSibling.remove();
    }
    const div = document.createElement("div");
    div.textContent = message;
    div.classList.add(class_);
    inputElement.insertAdjacentElement('afterend', div);
}


const nameRegex = /^[a-zA-ZàèìòùÀÈÌÒÙçÇ ]+$/; 

function validazione_cognome(event) {
    const result = nameRegex.test(event.currentTarget.value);
    if (!(result)) {
        printSentence(formNewAccount.last_name, "Insert a valid last name", "error");
    } else {
        if (formNewAccount.last_name.nextElementSibling.classList.contains('error')) {
            formNewAccount.last_name.nextElementSibling.remove();
        }    
    }
    return result;
}

function validazione_nome(event) {
    const result = nameRegex.test(event.currentTarget.value);
    if (!(result)) {
        printSentence(formNewAccount.first_name, "Insert a valid first name", "error");
    } else {
        if (formNewAccount.first_name.nextElementSibling.classList.contains('error')) {
            formNewAccount.first_name.nextElementSibling.remove();
        }    
    }
    return result;
}

formNewAccount.last_name.addEventListener("input", validazione_cognome);
formNewAccount.first_name.addEventListener("input", validazione_nome);



const emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
let validazioneEmail = true;
function validazione_email(event) {

    const result = emailRegex.test(String(event.currentTarget.value).toLowerCase()) 
    if(result){
        const mail = String(event.currentTarget.value).toLowerCase();
        fetch(`check_email/${mail}`).then(fetchResponse).then(jsonCheckEmail);
    } else {
        printSentence(formNewAccount.email, "Insert a valid email", "error");
        validazioneEmail=false;
    }
}

formNewAccount.email.addEventListener("input", validazione_email);

function fetchResponse(response) {
    if (!response.ok) return null;
    return response.json();
}

function jsonCheckEmail(json) {
    if (json.exists) {
        printSentence(formNewAccount.email, "Email already used", "error");
        validazioneEmail = false;
    } else {
        printSentence(formNewAccount.email, "Email valid", "right");
    }
}


const minLength = /.{8,}/;
const hasUppercase = /[A-Z]/;
const hasLowercase = /[a-z]/;
const hasNumber = /[0-9]/;
const hasSpecialChar = /[!@#$%^&*(),.?]/;

function validazione_password(event) {
    const result =  minLength.test(event.currentTarget.value) &&
                    hasUppercase.test(event.currentTarget.value) &&
                    hasLowercase.test(event.currentTarget.value) &&
                    hasNumber.test(event.currentTarget.value) &&
                    hasSpecialChar.test(event.currentTarget.value);
    
    if (result) {
        printSentence(formNewAccount.password, "This password is valid", "right");
    } else {
        printSentence(formNewAccount.password, 
            "Password must be at least 8 characters, 1 uppercase, 1 lowercase, 1 number and 1 special character [!@#$%^&*(),.?]", "error");
    }
    return result;
}

formNewAccount.password.addEventListener("input", validazione_password);


function matchPassword(){
    if(formNewAccount.password.value == formNewAccount.password_confirm.value){
        printSentence(formNewAccount.password_confirm, "Passwords match", "right"); 
        return true; 
    }
    else{
        printSentence(formNewAccount.password_confirm, "Passwords don't match", "error");   
        return false; 
    }
}

formNewAccount.password_confirm.addEventListener("input", matchPassword);

function checkPassordBeforSubmit(event){
    if(!validazione_password() || !matchPassword() || !validazione_nome() || !validazione_cognome() || validazioneEmail)
        event.preventDefault();
}

formNewAccount.addEventListener("submit", checkPassordBeforSubmit);


function checkInput(inputElement, errorMessage){
    if (inputElement.value.length == 0) {
        if (inputElement.nextElementSibling.classList.contains('error') || inputElement.nextElementSibling.classList.contains('right')) {
            inputElement.nextElementSibling.remove();
        }
        const error = document.createElement("div");
        error.textContent = errorMessage;
        error.classList.add("error");
        inputElement.insertAdjacentElement('afterend', error);
        inputElement.classList.add('error_input');
        return true;
    } else {
        return false;
    }
}

function validazione_input(event){
   
    (checkInput(formNewAccount.last_name, "Enter your last name"));
    (checkInput(formNewAccount.first_name, "Enter your first name"));
    (checkInput(formNewAccount.email, "Enter your email"));
    (checkInput(formNewAccount.password, "Enter your password"));
    (checkInput(formNewAccount.password_confirm, "Repeat password"));

    if((checkInput(formNewAccount.last_name, "Enter your last name")) || (checkInput(formNewAccount.first_name, "Enter your first name")) || 
    (checkInput(formNewAccount.email, "Enter your email")) || (checkInput(formNewAccount.password, "Eneter your password")) || (checkInput(formNewAccount.password_confirm, "Repeat password"))){

        event.preventDefault();
    }  
}

formNewAccount.addEventListener('submit', validazione_input);

