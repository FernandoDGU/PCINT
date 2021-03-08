$(document).ready(function(){
    $("#btn-searchOption").text("Selecciona ");

    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        var popoverList = popoverTriggerList.map(function (popoverTrigger) {
            return new bootstrap.Popover(popoverTrigger);
        });

        
});

function navbarChoosing(e){
    $("#btn-searchOption").text($(e).text() + " ");
    
}

function searchCondition(){
    let option = $("#btn-searchOption").text();
    let text = $("#searchText").val();
    if(option == "Selecciona "){
        alert("Selecciona algo");
        return false;
    }else if(text == "") {
        alert("Escribe algo");
        return false;
    }else { 
        window.location.href='pResultados.html'; 
        return false;
        
    };
}

function signUp(e){
    $("#userText").empty();
    switch(e){
        case "Alumno":{
            let text = "¿Qué esperas para registrarte? ¡Con el rol <i> estudiante </i> tendrás acceso a muchos cursos!";
            $("#userText").append(text);
            $("#signUp").modal('show');
            return false;
        }
        case "Escuela":{
            let text = "Descubre una comunidad de instructores en línea siempre dispuesta a ayudar. Obtén acceso inmediato a todas las herramientas de creación de cursos.";
            $("#userText").append(text);
            $("#signUp").modal('show');
            return false;
        }
    }
}
/*
function validateProfilePic(profilePic){
    let pp = $(profilePic).val();
    if(pp == ""){
        $("#constrProfilePic").slideDown();
        return false;
    }else{
        $("#constrProfilePic").slideUp();
        return true;
    }
}*/

function validateUserName(userName){
    $("#constrUserName").slideUp("fast");
    let name = $(userName).val();
    if (name.length < 1 || name.length > 20){
        $("#constrUserName").slideDown();
        return false;
    }else{
        $("#constrUserName").slideUp();
        return true;
    }
}

function validateEmailUser(emailUser){
    $("#constrEmail1").slideUp("fast");
    $("#constrEmail2").slideUp("fast");
        let returnValue = false;
        let email = $(emailUser).val();
        const emailPattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        let isIt = emailPattern.test(email);
        if(!isIt){
            $("#constrEmail1").slideDown();
            returnValue = false;
        }else{
            $("#constrEmail1").slideUp();
            returnValue = true;
        }
        if (email.length < 1 || email.length > 50){
            $("#constrEmail2").slideDown();
            returnValue = false;
        }else{
            $("#constrEmail2").slideUp();
            returnValue = true;
        }
        return returnValue;
}

function validateUserPass(password){
    $("#constrPassword").slideUp("fast");
    let regex = "^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9].*)(?=.*[@#$%^&+*!=]).*$";
    let passwordPattern = new RegExp(regex);
    let pass = $(password).val();
    let isIt = passwordPattern.test(pass);
    if(!isIt){
        $("#constrPassword").slideDown();
        return false;
    }else{
        $("#constrPassword").slideUp();
        return true;
    }
}

function validateFormSignUp()
{
    let userPass = validateUserPass("#userPass");
    let userName = validateUserName("#userName");
    //let userProfilePic = validateProfilePic("#profilePic");
    let userEmail = validateEmailUser("#userEmail");
    if(userPass && userName && userEmail){
        return true;
    }
        else {
            return false;
        }
    
    
}


function validateUserPassLI(password){
    $("#constrPasswordLI").slideUp("fast");
    let pass = $(password).val();
    if(pass.length == 0){
        $("#constrPasswordLI").slideDown();
        return false;
    }else{
        $("#constrPasswordLI").slideUp();
        return true;
    }
}

function validateEmailUserLI(emailUser){
    $("#constrEmailLI").slideUp("fast");
    let returnValue = false;
    let email = $(emailUser).val();
    const emailPattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    let isIt = emailPattern.test(email);
    if(!isIt){
        $("#constrEmailLI").slideDown();
        returnValue = false;
    }else{
        $("#constrEmailLI").slideUp();
        returnValue = true;
    }
    return returnValue;
}

function validateFormLogIn()
{
    let userPass = validateUserPassLI("#userPassLI");
    let userEmail = validateEmailUserLI("#userEmailLI");
    if(userPass && userEmail){
        return true;
    }
        else {
            return false;
        }
    
    
}
