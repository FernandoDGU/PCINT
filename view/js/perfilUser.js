$(document).ready(function(){

    

    $("#btn-cmu").click(function(){
        $('#modifyUser').modal('hide');
    });


    $( "#toggleStudents" ).click( function() {
        $("#toggleStudents").toggleClass('flip');
        $("#toggledStudents").slideToggle("slow");
    });

    $( "#toggleStudents2" ).click( function() {
        $("#toggleStudents2").toggleClass('flip');
        $("#toggledStudents2").slideToggle("slow");
    });

    $( "#btn-modifyCourse" ).click( function() {
        $('#modifyCourse').modal('show');
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

function showUserData(){
    $(".jsc-account").hide();
    $("#userData").show();
}

function showUserCourses(){
    $(".jsc-account").hide();
    $("#userCourses").show();
}

function showUserPurchases(){
    $(".jsc-account").hide();
    $("#userPurchases").show();
}

function showUserMessages(){
    $(".jsc-account").hide();
    $("#userMessages").show();
}



