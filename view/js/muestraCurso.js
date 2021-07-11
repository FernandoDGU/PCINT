$(document).ready(function(){

    $("#btn-addShop").click(function(){
            let idCurso = $("#idCurso").text();
            $.ajax({
                data:{
                    "idCurso" : idCurso
                },
                url: "../controller/insertarCarroEstudianteControlador.php?Peticion=Insertar",
                method: "POST",
                success: function(result){
                    if(result == 1){
                        
                        $('#btn-addShop').fadeOut(function(){
                            $('#btn-removeShop').fadeIn();
                        });
                        
                    }else{
                        console.log(result);
                        alert("Error agregando al carro.");
                    }
                }
            });
            

        
    });

    $("#btn-removeShop").click(function(){

        let idCurso = $("#idCurso").text();
        $.ajax({
            data:{
                "idCurso" : idCurso
            },
            url: "../controller/insertarCarroEstudianteControlador.php?Peticion=Borrar",
            method: "POST",
            success: function(result){
                if(result == 1){
                    
                    $('#btn-removeShop').fadeOut(function(){
                        $('#btn-addShop').fadeIn();
                    });
                    
                }else{
                    console.log(result);
                    alert("Error agregando al carro.");
                }
            }
        })

       
    });

});