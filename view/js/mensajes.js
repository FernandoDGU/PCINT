$(document).ready(function(){
    $("#sendMessage").click(function(){
        let text = $("#txta-message").val();
        let correoSeleccionado = $("#correoSeleccionado").text()
        if(text != "" && correoSeleccionado != ""){
        
            $.ajax({
                data:{
                    "correo": correoSeleccionado,
                    "mensaje": text
                },
                url: "../../../controller/insertarMensajesControlador.php",
                method: "POST",
                success: function(result){
                    console.log(result)
                    llenarChat(correoSeleccionado);
                }
            });
        
        
        $("#txta-message").val("");
    }
    });


        
});

function mostrarChat(correo, nombre){
    $("#imageChat").attr("src","../../../controller/showUserImage.php?correo="+correo);
    $("#nameChat").text(nombre)
    llenarChat(correo);
    
}

function llenarChat(correo){
    let correoActual = $("#correoActual").text()
    $("#correoSeleccionado").text(correo)

    $.ajax({
        dataType: "JSON",
        data:{
            "correo": correo
        },
        url: "../../../controller/traerMensajesControlador.php",
        method: "POST",
        success: function(result){
            $('#messageHistory').empty();
            $.each(result, function(k,v) {
                if(v.correo_remitente == correoActual){
                    let div = `
                        <div class="col-12 text-center">
                            <small>${v.fechaHora}</small>
                        </div>
                        <div class="col-lg-7 col-9 ms-auto d-flex">
                            <div class="messages ms-auto" style="background-color: rgba(130, 216, 219, 0.596);">
                            
                            ${v.mensaje}
                            
                            </div>
                        </div>
                        <br>
                        `;
                    $('#messageHistory').append(div);
                }else{
                    let div = `
                        <div class="col-12 text-center">
                            <small>${v.fechaHora}</small>
                        </div>
                        <div class="border-bottom col-lg-7 col-9 me-auto d-flex messages" style="background-color: rgba(95, 158, 160, 0.596);">
                            
                            ${v.mensaje}
                            
                        </div>
                        <br>
                        `;
                    $('#messageHistory').append(div);
                }
                
                
            })
        }
    });
}