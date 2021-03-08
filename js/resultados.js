$(document).ready(function(){
    

    $('.goToCourse').click(function(){
        window.location.href='muestraCurso.html';
     })



        
});

function newActive(e){
    $('.active-cat').removeClass("active-cat");
    $(e).addClass("active-cat");
}