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
        window.location.href='Home.html';
    }

});
        
});

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