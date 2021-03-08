$(document).ready(function(){

    $("#btn-addShop").click(function(){
        $('#btn-addShop').fadeOut(function(){
            $('#btn-removeShop').fadeIn();
        });
    });

    $("#btn-removeShop").click(function(){
        $('#btn-removeShop').fadeOut(function(){
            $('#btn-addShop').fadeIn();
        });
    });

});