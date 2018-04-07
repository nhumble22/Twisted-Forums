function register() {
    $('#register-checkbox').prop('checked', true)
    $('.register-button').toggleClass('selected-button');
    $('.login-button').removeClass('selected-button');
    if ($('#login-checkbox').prop('checked', true)) {
        $('#login-checkbox').prop('checked', false); 
    }
}
function login() {
    $('#login-checkbox').prop('checked', true)
    $('.login-button').toggleClass('selected-button');
    $('.register-button').removeClass('selected-button');
    if ($('#register-checkbox').prop('checked', true)) {    
        $('#register-checkbox').prop('checked', false); 
    }
}

$('.register-button').click(function() {
    $('.register-button').toggleClass('selected-button');
    $('.login-button').removeClass('selected-button');
    if ($('#login-checkbox').prop('checked', true)) {
        $('#login-checkbox').prop('checked', false); 
    }
})
$('.login-button').click(function() {
    $('.login-button').toggleClass('selected-button');
    $('.register-button').removeClass('selected-button');
    if ($('#register-checkbox').prop('checked', true)) {
        $('#register-checkbox').prop('checked', false); 
    }
})

function logout() {
    $('#logout-button').toggleClass('selected-button');
    $('#add-page-button').removeClass('selected-button');
    if ($('#add-page-checkbox').prop('checked', true)) {
        $('#add-page-checkbox').prop('checked', false); 
    }
}
function addPage() {
    $('#add-page-button').toggleClass('selected-button');
    $('#logout-button').removeClass('selected-button');
    if ($('#logout-checkbox').prop('checked', true)) {
        $('#logout-checkbox').prop('checked', false); 
    }
}

$( ".input" ).keyup(function() {
    var $this  = $(this);
   $this.css('background-color', '#e9f0f4');
});

//Error Defaults and inputs
//inputs
var $registerEmail = $('#registerEmail');
var $registerUsername = $('#registerUsername');
var $registerPassword= $('#registerPassword');

var $loginEmail = $('#loginEmail');
var $loginPassword= $('#loginPassword');

var $topicTitle = $('#topicTitle');
var $topicContent= $('#topicContent');

var $postContent= $('#postContent');

//input error container h4's
var $registerEmailError = $('#registerEmailError');
var $registerUsernameError = $('#registerUsernameError');
var $registerPasswordError = $('#registerPasswordError');

var $loginEmailError = $('#loginEmailError');
var $loginPasswordError = $('#loginPasswordError');

var $topicError = $('#topicError');

var $postContentError = $('#replyError');

function hasError(input) {
    input.addClass('shatter');
    input.css('background-color', '#fcbeba');
        setTimeout(function(){
            input.removeClass('shatter');
        }, 500);
    return event.preventDefault();  
}

function errorAlert(errorContainer, errorMessage) {
    errorContainer.html( errorMessage );
}

function validateEmail(email) {
    var regex = /^([0-9a-zA-Z]([-_\\.]*[0-9a-zA-Z]+)*)@([0-9a-zA-Z]([-_\\.]*[0-9a-zA-Z]+)*)[\\.]([a-zA-Z]{2,9})$/;
    if(!regex.test(email)){
        return false;
    } else {
        return true;
    }
}

$( ".form" ).submit(function( event ) { 
    var $this = $(this);
    //REGISTER FORM
    if ($this.hasClass('registerForm')) { 
        //email
        if ($registerEmail.val().length != 0) {
            if (!validateEmail($registerEmail.val())) {
                    hasError($registerEmail);  
                    errorAlert($registerEmailError, "Email not valid");  
                } else {
                //all OK
                errorAlert($registerEmailError, "");
                }
        } else {
            hasError($registerEmail);  
            errorAlert($registerEmailError, "Required");    
        }
        //username
        if ($registerUsername.val().length != 0) {
            var regex = /^[a-zA-Z ]*$/;
            if ($registerUsername.val().length < 6) {
                hasError($registerUsername);  
                errorAlert($registerUsernameError, "Minimum 6 characters");
            } else if(!regex.test($registerUsername.val())){
                hasError($registerUsername);  
                errorAlert($registerUsernameError, "Invalid - Letters only");
            } else {
                //all OK
                errorAlert($registerUsernameError, "");
            }
        } else {
            hasError($registerUsername);  
            errorAlert($registerUsernameError, "Required");    
        }
        //password
        if ($registerPassword.val().length != 0) {
            if ($registerPassword.val().length < 6) {
                hasError($registerPassword);  
                errorAlert($registerPasswordError, "Minimum 6 characters");  
            } else {
                //all OK
                errorAlert($registerPasswordError, "");
            }
        } else {
            hasError($registerPassword);  
            errorAlert($registerPasswordError, "Required");    
        }
    }
    //LOGIN FORM
    if ($this.hasClass('loginForm')) { 
        //email
        if ($loginEmail.val().length != 0) {
            if (!validateEmail($loginEmail.val())) {
                hasError($loginEmail);  
                errorAlert($loginEmailError, "Email not valid");  
            } else {
                //all OK
                errorAlert($loginEmailError, "");
            }
        } else {
            hasError($loginEmail);  
            errorAlert($loginEmailError, "Required");  
        }
        //password
        if ($loginPassword.val().length != 0) {
            //all OK
                errorAlert($loginPasswordError, "");
        } else {
            hasError($loginPassword);  
            errorAlert($loginPasswordError, "Required");
        }
    }
    //TOPIC FORM
    if ($this.hasClass('topicForm')){
        //title and content
        if ($topicTitle.val().length === 0 || $topicContent.val().length === 0) {
            errorAlert($topicError, "All fields are required");
            if ($topicTitle.val().length === 0) {
                hasError($topicTitle);
            }
            if ($topicContent.val().length === 0) {
                hasError($topicContent);
            }
        } else if ($topicTitle.val().length < 10 || $topicContent.val().length < 10) {
            errorAlert($topicError, "Minimum 10 characters per field");
            if ($topicTitle.val().length < 10) {
                hasError($topicTitle);
            }
            if ($topicContent.val().length < 10) {
                hasError($topicContent);
            }            
        } else {
            errorAlert($topicError, "");
        }    
    }
    //REPLY FORM
    if ($this.hasClass('replyForm')){
        //post content
        if ($postContent.val().length != 0) {
            if ($postContent.val().length < 10) {
                hasError($postContent);
                errorAlert($postContentError, "Reply has a minimum of 10 characters");
            } else {
                //all ok
                errorAlert($topicError, "");
            }         
        } else {
            hasError($postContent);
            errorAlert($postContentError, "Required");
        }   
    }
});

