$(document).ready(function(){

    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        var popoverList = popoverTriggerList.map(function (popoverTrigger) {
            return new bootstrap.Popover(popoverTrigger);
        });

    $("#btn-modificar").click(function(e){
        e.preventDefault();
        let userPass = validateUserPass("#userPass");
        let userName = validateUserName("#userName");
        let userEmail = validateEmailUser("#userEmail");
        /*let nombre = $("#userName").val();
        let contra = $("#userPass").val();*/

            
                if(userPass && userName && userEmail){
                    var form = $('#form-modifUser')[0];
                    var data = new FormData(form);
                    $.ajax({
                        type: "POST",
                        url: "../../../controller/actualizarUserControlador.php",
                        enctype: 'multipart/form-data',
                        data: data,
                        processData: false,
                        contentType: false,
                        success: function(result){
                            console.log(result);
                            if(result == 1){
                                $("#confirmationModifyUser").modal("show");
                                
                            }else{
                                alert("Hubo un error modificando.");
                            }
                        }
                    });
                }
            

    });

    $("#btn-cmu").click(function(){
        $("#form-modifUser").submit();
    });



    $("#btn-modifUser").click(function(){
        $.ajax({
            dataType: "JSON",
            url: "../../../controller/perfilDatosAlumnoControlador.php?Origen=AJAX",
            method: "POST",
            success: function(result){
                $("#userEmail").val(result[0]);
                $("#userName").val(result[1]);
                $("#userPass").val(result[2]);
                $('#modifyUser').modal('show');
            }
        });

       
        
    });

    


    $( "#toggleStudents" ).click( function() {
        $("#toggleStudents").toggleClass('flip');
        $("#toggledStudents").slideToggle("slow");
    });

    $( "#toggleStudents2" ).click( function() {
        $("#toggleStudents2").toggleClass('flip');
        $("#toggledStudents2").slideToggle("slow");
    });

    

/*
    $("input#profilePic").change(function () {
        var div ="<div class='col-lg-2 col-sm-6 mx-auto d-flex flex-column justify-content-center align-items-center'>" +
        "<img src="+ $(this).val() +" class='img-fluid img-thumbnail rounded-pill' "+
          "style='border: 4px outset #0014F5;' alt=''>" +
      "</div>";
      $("div.modal-body").append(div);
    });
*/
});

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





