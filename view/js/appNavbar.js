
$(document).ready(function(){
    $("#btn-searchOption").text("Selecciona ");

    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        var popoverList = popoverTriggerList.map(function (popoverTrigger) {
            return new bootstrap.Popover(popoverTrigger);
        });

        $("#btn-SignUp").click(function(e){
            e.preventDefault();
            $("#signUp-error").slideUp();
            let userPass = validateUserPass("#userPass");
            let userName = validateUserName("#userName");
            let userProfilePic = validateProfilePic("#profilePic");
            let userEmail = validateEmailUser("#userEmail");
        
            /*let name = $("#userName").val();
            let pass = $("#userPass").val();
            let pic =  $("#profilePic").val();
            let email = $("#userEmail").val();
            */
            
            rol = $("#tipoUsuario").val();

            
            if(userPass && userName && userEmail && userProfilePic){
                var form = $('#form-SignUp')[0];
                var data = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: "../controller/RegistrarControladorAJAX.php",
                    enctype: 'multipart/form-data',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(result){
                        if(result == 1){
                            
                            $("#form-SignUp").submit();
                        }else if(result == 0){
                            $("#signUp-error").slideDown();
                        }
                        else{
                            console.log(result);
                        }
                    }
                });
            }
                
        });

        $("#btn-LogIn").click(function(e){
            e.preventDefault();
            $("#logIn-error").slideUp();
            let userPass = validateUserPassLI("#userPassLI");
            let userEmail = validateEmailUserLI("#userEmailLI");
            let email = $("#userEmailLI").val();
            let pass = $("#userPassLI").val();
            
            if(userPass && userEmail){
            $.ajax({
                data:{
                    "emailAJAX" : email,
                    "passAJAX" : pass
                },
                url: "../controller/iniciarSesionControladorAJAX.php",
                method: "POST",
                success: function(result){
                    if(result){
                        
                        $("#form-LogIn").submit();
                    }else{
                        $("#logIn-error").slideDown();
                    }
                }
            });
            }
            
        });

        
        
});

function navbarChoosing(e){
    $("#btn-searchOption").text($(e).text() + " ");
    
}

function searchCondition(){
    let option = $("#btn-searchOption").text();
    let text = $("#searchText").val();
    option = option.replace(/\s/g, '');
    if(option == "Selecciona"){
        alert("Selecciona algo");
        return false;
    }else if(text == "") {
        alert("Escribe algo");
        return false;
    }else { 
        window.location.href=`pResultados.php?option=${option}&text=${text}`; 
        return false;
        
    };
}

function signUp(e){
    $("#userText").empty();
    $(".error-dm").hide();
    let rol = $("#tipoUsuario");
    switch(e){
        case "Alumno":{
            let text = "¿Qué esperas para registrarte? ¡Con el rol <i> estudiante </i> tendrás acceso a muchos cursos!";
            rol.val(1);
            $("#userText").append(text);
            $("#signUp").modal('show');
            return false;
        }
        case "Escuela":{
            let text = "Descubre una comunidad de instructores en línea siempre dispuesta a ayudar. Obtén acceso inmediato a todas las herramientas de creación de cursos.";
            rol.val(0);
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

function validateProfilePic(profilePic){
    $("#constrProfilePic").slideUp("fast");
    let pic = $(profilePic).val();
    if(pic){
        $("#constrProfilePic").slideUp();
        return true;
    }
    else{
        $("#constrProfilePic").slideDown();
        return false;
    }
}

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
        let returnValue2 = false;
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
            returnValue2 = false;
        }else{
            $("#constrEmail2").slideUp();
            returnValue2 = true;
        }
        if(returnValue && returnValue2){
        return true;
        }else return false;
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
    
    
    
}
