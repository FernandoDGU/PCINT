$(document).ready(function(){
    $("#chapter2").prop("indeterminate", true);
    $('#comments').hide();
    $("#endCourse").hide();
    $("#dip").hide();
    $("#btn-show-description").click(function(){
        $('#comments').hide();
        $('#description').show();
    });

    $("#btn-show-comments").click(function(){
        $('#description').hide();
        $('#comments').show();
    });

    $('video').on('ended',function(){
        
        $("#chapter2").prop("indeterminate", false);
        $(".form-check-input").prop( "checked", true );
        $("#chapter3").prop("indeterminate", true);
        $(".progress-done").animate({
            width: '+=50px'
          }, "slow");
          $(".progress-done").text("100%");
          $("#endCourse").fadeIn();
          $("#dip").fadeIn();
      });
      
      $("#btn-comment").click(function(){
        $('#error-punctuation').slideUp("fast");
        let punctuation;
        let commentBody;
        if($('#btnradio4').is(':checked') || $('#btnradio3').is(':checked') ) { $('#error-punctuation').slideUp(); punctuation = true;}
        else {$('#error-punctuation').slideDown(); punctuation = false;}
        if($('#commentBody').val() != "") { $('#error-commentBody').slideUp(); commentBody = true; }
        else { $('#error-commentBody').slideDown(); commentBody = false; }

        if(punctuation && commentBody)
        {  $('#endCourse').slideUp();   }
    });
      


});