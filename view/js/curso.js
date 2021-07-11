$(document).ready(function(){
    /*$("#chapter2").prop("indeterminate", true);
    $('#comments').hide();
    $("#endCourse").hide();
    $("#dip").hide();*/

    $("#btn-show-description").click(function(){
        $('#comments').hide(function(){
            $('#description').show('slow');
        });
        
    });

    $("#btn-show-comments").click(function(){
        $('#description').hide(function(){
            $('#comments').show('slow');
        });
        
    });

    /*$('video').on('ended',function(){
        
        $("#chapter2").prop("indeterminate", false);
        $(".form-check-input").prop( "checked", true );
        $("#chapter3").prop("indeterminate", true);
        $(".progress-done").animate({
            width: '+=50px'
          }, "slow");
          $(".progress-done").text("100%");
          $("#endCourse").fadeIn();
          $("#dip").fadeIn();
      });*/
      
      $("#btn-comment").click(function(){
        $('#error-punctuation').slideUp("fast");
        let punctuation;
        let commentBody;
        if($('#btnradio4').is(':checked') || $('#btnradio3').is(':checked') ) { $('#error-punctuation').slideUp(); punctuation = true;}
        else {$('#error-punctuation').slideDown(); punctuation = false;}
        if($('#commentBody').val() != "") { $('#error-commentBody').slideUp(); commentBody = true; }
        else { $('#error-commentBody').slideDown(); commentBody = false; }

        if(punctuation && commentBody)
        { 
            let idCurso = $("#idCurso").text();
            let comentario = $('#commentBody').val();
            let voto;
            if($('#btnradio4').is(':checked'))
                voto = false;
            else
                voto = true;
            $.ajax({
                data:{
                    "id_curso" : idCurso,
                    "comentario" : comentario,
                    "voto" : voto
                },
                url: "../controller/insertarComentarioControlador.php",
                method: "POST",
                success: function(result){
                    if(result == 1){
                        $('#endCourse').slideUp(function(){
                            window.location.href=`curso.php?cap=1&id=${idCurso}`;
                        });
                       
                    }else{
                        console.log(result);
                        alert("Ha ocurrido un error comentando el curso.");
                    }
                }
            });
               }
    });
      


});


function cambiarContenido(numCap){
    let unchecked = !$('#chbNumCap'+numCap).prop('checked')
    let disabled =  $('#chbNumCap'+numCap).prop('disabled')
    
    if (unchecked && disabled) {
    }else{
        let idCurso = $("#idCurso").text();
        window.location.href=`curso.php?cap=${numCap}&id=${idCurso}`;
    }
}

function capituloCompletado(numCap){
    let cantCap = $("#cantCap").text();
    let cantVisto = $("#cantVisto").text();
    let unchecked = $('#chbNumCap'+numCap).prop('checked')
    let disabled =  !$('#chbNumCap'+numCap).prop('disabled')
    if (unchecked && !disabled) {
    }else{

            let idCurso = $("#idCurso").text();
            $.ajax({
                data:{
                    "id_curso" : idCurso,
                    "cantidadCapitulos" : cantCap,
                    "cantidadVistos" : cantVisto
                },
                url: "../controller/actualizarProgresoController.php",
                method: "POST",
                
                success: function(result){
                    if(result == 1){
                        $('#chbNumCap'+numCap).prop('disabled', true)
                        cantVisto++;
                        $("#cantVisto").text(cantVisto);
                        $(".progress-done").animate({
                            width: `+=${agregarPorcentajeBarra()}px`
                        }, "slow");
                        let progress = agregarPorcentaje(cantVisto)+"%";
                        $(".progress-done").text(progress);
                        if(cantCap != cantVisto)
                        {
                            
                            $('#chbNumCap'+(numCap+1)).prop('disabled', false)
                            
                        }else{
                            $("#endCourse").fadeIn();
                        $("#dip").fadeIn();
                        }
                       
                    }else{
                        console.log(result);
                        alert("Ha ocurrido un error actualizando el progreso del curso.");
                    }
                }
            });
            

        
    }
}

function agregarPorcentajeBarra(){
    let cantCap = $("#cantCap").text();
    let porcentaje = (1 / cantCap) * 300;

    return Math.round(porcentaje);
}

function agregarPorcentaje(capVistos){
    let cantCap = $("#cantCap").text();
    let porcentaje = (capVistos / cantCap) * 100;

    return Math.round(porcentaje);
}