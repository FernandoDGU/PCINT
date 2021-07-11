$(document).ready(function(){
    
$('#btn-buy').click(function(){
    $("#error-expireCard").slideUp("fast");
    let numberCard = checkNumberLength($("#NumTarjeta"), "#error-numberCard", 16);
    let nameCard = checkIsEmpty($("#Propietario"), "#error-nameCard");
    let securityCard = checkNumberLength($("#Cod-Seguridad"), "#error-securityCard", 3);
    let mmCard;
    let aaCard;
    let letter_E = new RegExp("e");
    let m = $("#MM").val();
    let a = $("#AA").val();
    if(m > 0 && !letter_E.test(m) && m.length == 2){
        mmCard = true;
    }
    else{
        mmCard = false;
    }
    if(a > 0 && !letter_E.test(a) && a.length == 2){
        aaCard = true;
    }
    else{
        aaCard = false;
    }
    if(aaCard == false || mmCard == false){
        $("#error-expireCard").slideDown();
    }
    else{
        $("#error-expireCard").slideUp();
    }

    if( numberCard && nameCard && securityCard && aaCard && mmCard){
        //window.location.href='Home.html';

        comprarCursos()

    }

});


        
});

function comprarCursos(){
    $.ajax({
        url: "../controller/comprarCursosController.php",
        method: "POST",
        success: function(result){
            if(result == 1){
                
                window.location.href='perfil/perfilAlumno/cursosUsuario.php';
                
            }else{
                console.log(result);
                alert("Error comprando cursos.");
            }
        }
    })
}

function borrarCursoCarro(idCurso){
    let precio = $("#precio"+idCurso).text();
    let precioTotal = $("#precioTotal").text();
    
    $.ajax({
        data:{
            "idCurso" : idCurso
        },
        url: "../controller/insertarCarroEstudianteControlador.php?Peticion=Borrar",
        method: "POST",
        success: function(result){
            if(result == 1){
                
                precioTotal = precioTotal - precio;
                $("#precioTotal").text(precioTotal)
                $("#curso"+idCurso).slideUp();
                
            }else{
                console.log(result);
                alert("Error agregando al carro.");
            }
        }
    })

    
    //alert(precio);
}

function checkNumberLength(e, error, l){
    $(error).slideUp("fast");
    let letter_E = new RegExp("e");
    let m = $(e).val();
    if(m > 0 && !letter_E.test(m) && m.length == l){
        $(error).slideUp();
        return true;
    }
    else{
        $(error).slideDown();
        return false;
    }
}


function checkIsEmpty(e, error){
    $(error).slideUp("fast");
    
    
    let input = $(e).val();
    if(input != ""){
        $(error).slideUp();
        return true;
    }
    else{
        $(error).slideDown();
        return false;
    }
}