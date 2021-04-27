$(document).ready(function(){
    //alert("Hola Mundo");
    $(".error-dm").hide();

    $("#createChapter").click(function(){
        $('#confirmationModal').modal('show');
    });

    $("#closeModal").click(function(){
        $('#confirmationModal').modal('hide');
        $('#createCourse').modal('hide');
        $('#modifyCourse').modal('hide');
    });

    $("#btn-createCategory").click(function(){

        let valid;
        valid = !checkLength( '#newCategoryInput', '#error-newCategoryC', 31 );
        valid = !checkIsEmpty( '#newCatDescription', '#error-newCategoryDescriptionC');
        if(valid){
        let cat_name = $('#newCategoryInput').val();
        let cat_description = $('#newCatDescription').val();
        let div = `<option value="${cat_name}" id="cat-${cat_name}">${cat_name}</option>`;
        $('#categoryBoxC').append(div);
        $('#newCatDescription').val("");
        $('#newCategoryInput').val("");
        
        }
    });

    $("#btn-createCategoryM").click(function(){

        let valid;
        valid = !checkLength( '#newCategoryInputM', '#error-newCategoryM', 31 );
        valid = !checkIsEmpty( '#newCatDescriptionM', '#error-newCategoryDescriptionM');
        if(valid){
        let cat_name = $('#newCategoryInputM').val();
        let cat_description = $('#newCatDescriptionM').val();
        let div = `<option value="${cat_name}" id="catM-${cat_name}">${cat_name}</option>`;
        $('#categoryBoxM').append(div);
        $('#newCatDescriptionM').val("");
        $('#newCategoryInputM').val("");
        }
    });

    $("#btn-createCourse").click(function(){

        let cuentaCap = $("#totalChapters").text();
        let valid = 0;
        valid += checkCategoriesCourse();
        valid += checkLength( '#courseImageC', '#error-imageCourseC',  31);
        valid += checkIsEmpty( '#nameCourseC', '#error-nameCourseC' );
        valid += checkLength( '#sDescriptionCourseC', '#error-sDescriptionCourseC', 66 );
        valid += checkIsEmpty( '#DescriptionCourseC', '#error-DescriptionCourseC');
        valid += checkMoney( '#moneyCourseC', '#error-moneyCourseC' );

        valid += checkLength( '#name-chapter', '#error-name-chapter',  31);
        valid += checkIsEmpty( '#description-chapter', '#error-description-chapter' );
        valid += checkIsEmpty( '#video-chapter', '#error-video-chapter' );


        
        if(cuentaCap != 1)
        {
            for(let i = 2; i <= cuentaCap; i++){
                valid += checkLength( '#name-chapter' + i, '#error-name-chapter' + i,  31);
                valid += checkIsEmpty( '#description-chapter' + i, '#error-description-chapter' + i );
                valid += checkIsEmpty( '#video-chapter' + i, '#error-video-chapter' + i );
            }
        }

        if(valid == 0){
            alert("Nice");
        }
    });

    $("#btn-modifyCourse2").click(function(){

        let cuentaCap = $("#totalChaptersM").text();
        let valid = 0;
        valid += checkCategoriesCourseM();
        //valid += checkLength( '#courseImageM', '#error-imageCourseM',  31);
        valid += checkIsEmpty( '#nameCourseM', '#error-nameCourseM' );
        valid += checkLength( '#sDescriptionCourseM', '#error-sDescriptionCourseM', 66 );
        valid += checkIsEmpty( '#DescriptionCourseM', '#error-DescriptionCourseM');
        valid += checkMoney( '#moneyCourseM', '#error-moneyCourseM' );

        valid += checkLength( '#name-chapterM', '#error-name-chapterM',  31);
        valid += checkIsEmpty( '#description-chapterM', '#error-description-chapterM' );
        //valid += checkIsEmpty( '#video-chapterM', '#error-video-chapterM' );


        
        if(cuentaCap != 1)
        {
            for(let i = 2; i <= cuentaCap; i++){
                valid += checkLength( '#name-chapterM' + i, '#error-name-chapterM' + i,  31);
                valid += checkIsEmpty( '#description-chapterM' + i, '#error-description-chapterM' + i );
                valid += checkIsEmpty( '#video-chapterM' + i, '#error-video-chapterM' + i );
            }
        }

        if(valid == 0){
            alert("Nice");
        }
    });

    $("#removeChapter").click(function(){
        let cuentaCap = $("#totalChapters").text();
        let lastId = "#accordion" + cuentaCap;
        $(lastId).remove()
        cuentaCap--;
        $("#totalChapters").text(cuentaCap);
        if(cuentaCap == 1){
            $('#removeChapter').prop('disabled', true);
        }

    });

    $("#removeChapterM").click(function(){
        let cuentaCap = $("#totalChaptersM").text();
        let lastId = "#accordionM" + cuentaCap;
        $(lastId).remove()
        cuentaCap--;
        $("#totalChaptersM").text(cuentaCap);
        if(cuentaCap == 1){
            $('#removeChapterM').prop('disabled', true);
        }

    });

    $("#addChapter").click(function(){

        let cuentaCap = $("#totalChapters").text();
        cuentaCap++;

        var div = "<div id='accordion"+cuentaCap+"' class='accordion-item'>" +
        "<h2 class='accordion-header' id='heading"+ cuentaCap +"'>" +
        "<button class='accordion-button collapsed' type='button' data-bs-toggle='collapse'" +
        "data-bs-target='#collapse"+ cuentaCap +"' aria-expanded='true' aria-controls='collapse"+ cuentaCap +"'>" +
        "Capítulo #"+ cuentaCap +
        "</button>"+
        "</h2>"+
        "<div id='collapse"+ cuentaCap +"' class='accordion-collapse collapse' aria-labelledby='heading"+ cuentaCap +"'"+
        "data-bs-parent='#accordionExample'>"+
        "<div class='accordion-body'>"+

        "<div class='col-12'>"+
        "<div class='input-group '>"+
        "<span class='input-group-text col-lg-2 col-12' id='basic-addon1'><i"+
        "class='fas fa-graduation-cap'></i>&nbsp;Título del capítulo</span>"+
        " <input type='text' id='name-chapter"+cuentaCap+"' class='form-control' placeholder='Máximo 30 carácteres'"+
        "    aria-label='Username' aria-describedby='basic-addon1' onfocusout='checkLength(this, \`#error-name-chapter"+cuentaCap+"\`, 31)'>"+
        "   </div>"+
        "<p id='error-name-chapter"+cuentaCap+"' class='error-dm' style='display:none;'>" +
        "El título del capítulo excede los 30 carácteres permitidos o se " +
        "encuentra vacío." +
        "</p>" +
        " </div>"+

        "<div class='col-12'>"+
        "<div class='input-group mt-3'>"+
        "    <span class='input-group-text col-lg-2 col-12'><i"+
        "            class='fas fa-edit'></i>&nbsp;Descripción</span>"+
        "    <textarea class='form-control' id='description-chapter"+cuentaCap+"' placeholder='Descripción principal'"+
        "          aria-label='With textarea' onfocusout='checkIsEmpty(this, \`#error-description-chapter"+cuentaCap+"\`)'></textarea>"+
        "    </div>"+
        "<p id='error-description-chapter"+cuentaCap+"' class='error-dm' style='display:none;'>" +
        "Debes agregar una descripción." +
        "</p>" +
        "   </div>"+

        " <div class='col-12'>"+
        "   <div id='' class='mt-5'>"+
        "      <div class=''>"+
                  "          <div class='form-group'>"+
                  " <label>Video del capítulo <small"+
                  "    style='color:red'>*Obligatorio*</small></label>"+
                  "    <input name='videos' id='video-chapter"+cuentaCap+"' type='file' class='form-control' accept='video/*' onchange='checkIsEmpty(this, \`#error-video-chapter"+cuentaCap+"\`)'>"+
                  "    </div>"+
                  "<p id='error-video-chapter"+cuentaCap+"' class='error-dm' style='display:none;'>" +
                  "Debes agregar una descripción." +
                  "</p>" +
                  "    </div>"+
                  "     </div>"+
                  "   </div>"+
                  "   <div class='col-12'>"+
                  "  <div id='' class='mt-5'>"+
                  "      <div class=''>"+
                  "          <div class='form-group'>"+
                  "             <label>Imagen del capítulo</label>"+
                  "              <input name='videos' type='file' class='form-control' accept='image/*'>"+
                  "         </div>"+
                  "      </div>"+
                  "  </div>"+
                  " </div>"+
                  " <div class='col-12'>"+
                  "     <div id='' class='mt-5 mb-5'>"+
                  "         <div class=''>"+
                  "            <div class='form-group'>"+
                  "                <label>Archivo del capítulo <small>*Solo pdf*</small></label>"+
                  "               <input name='videos' type='file' class='form-control'"+
                  "                   accept='application/pdf'>"+
                  "           </div>"+
                  "       </div>"+
                  "    </div>"+
                  "  </div>"+


                  " <div class='form-check mt-5'>"+
                  "    <input class='form-check-input' type='checkbox' value='' id='flexCheckDefault'>"+
                  "    <label class='form-check-label' for='flexCheckDefault'>"+
                  "      Ofrecer como capítulo gratuito."+
                  "    </label>"+
                  "    </div>"+

                  " </div>"+
                  " </div>"+
                  " </div>";
        $("#accordionExample").append(div);
        $("#totalChapters").text(cuentaCap);
        
        if(cuentaCap!= 1){
            $('#removeChapter').prop('disabled', false);
        }
    });

    $("#addChapterM").click(function(){

        let cuentaCap = $("#totalChaptersM").text();
        cuentaCap++;

        var div = "<div id='accordionM"+cuentaCap+"' class='accordion-item'>" +
        "<h2 class='accordion-header' id='headingM"+ cuentaCap +"'>" +
        "<button class='accordion-button collapsed' type='button' data-bs-toggle='collapse'" +
        "data-bs-target='#collapseM"+ cuentaCap +"' aria-expanded='true' aria-controls='collapseM"+ cuentaCap +"'>" +
        "Capítulo #"+ cuentaCap +
        "</button>"+
        "</h2>"+
        "<div id='collapseM"+ cuentaCap +"' class='accordion-collapse collapse' aria-labelledby='headingM"+ cuentaCap +"'"+
        "data-bs-parent='#accordionExampleM'>"+
        "<div class='accordion-body'>"+

        "<div class='col-12'>"+
        "<div class='input-group '>"+
        "<span class='input-group-text col-lg-2 col-12' id='basic-addon1'><i"+
        "class='fas fa-graduation-cap'></i>&nbsp;Título del capítulo</span>"+
        " <input type='text' id='name-chapterM"+cuentaCap+"' class='form-control' placeholder='Máximo 30 carácteres'"+
        "    aria-label='Username' aria-describedby='basic-addon1' onfocusout='checkLength(this, \`#error-name-chapterM"+cuentaCap+"\`, 31)'>"+
        "   </div>"+
        "<p id='error-name-chapterM"+cuentaCap+"' class='error-dm' style='display:none;'>" +
        "El título del capítulo excede los 30 carácteres permitidos o se " +
        "encuentra vacío." +
        "</p>" +
        " </div>"+

        "<div class='col-12'>"+
        "<div class='input-group mt-3'>"+
        "    <span class='input-group-text col-lg-2 col-12'><i"+
        "            class='fas fa-edit'></i>&nbsp;Descripción</span>"+
        "    <textarea class='form-control' id='description-chapterM"+cuentaCap+"' placeholder='Descripción principal'"+
        "          aria-label='With textarea' onfocusout='checkIsEmpty(this, \`#error-description-chapterM"+cuentaCap+"\`)'></textarea>"+
        "    </div>"+
        "<p id='error-description-chapterM"+cuentaCap+"' class='error-dm' style='display:none;'>" +
        "Debes agregar una descripción." +
        "</p>" +
        "   </div>"+

        " <div class='col-12'>"+
        "   <div id='' class='mt-5'>"+
        "      <div class=''>"+
                  "          <div class='form-group'>"+
                  " <label>Video del capítulo <small"+
                  "    style='color:red'>*Obligatorio*</small></label>"+
                  "    <input name='videos' id='video-chapterM"+cuentaCap+"' type='file' class='form-control' accept='video/*' onchange='checkIsEmpty(this, \`#error-video-chapterM"+cuentaCap+"\`)'>"+
                  "    </div>"+
                  "<p id='error-video-chapterM"+cuentaCap+"' class='error-dm' style='display:none;'>" +
                  "Debes agregar una descripción." +
                  "</p>" +
                  "    </div>"+
                  "     </div>"+
                  "   </div>"+
                  "   <div class='col-12'>"+
                  "  <div id='' class='mt-5'>"+
                  "      <div class=''>"+
                  "          <div class='form-group'>"+
                  "             <label>Imagen del capítulo</label>"+
                  "              <input name='videos' type='file' class='form-control' accept='image/*'>"+
                  "         </div>"+
                  "      </div>"+
                  "  </div>"+
                  " </div>"+
                  " <div class='col-12'>"+
                  "     <div id='' class='mt-5 mb-5'>"+
                  "         <div class=''>"+
                  "            <div class='form-group'>"+
                  "                <label>Archivo del capítulo <small>*Solo pdf*</small></label>"+
                  "               <input name='videos' type='file' class='form-control'"+
                  "                   accept='application/pdf'>"+
                  "           </div>"+
                  "       </div>"+
                  "    </div>"+
                  "  </div>"+


                  " <div class='form-check mt-5'>"+
                  "    <input class='form-check-input' type='checkbox' value='' id='flexCheckDefault'>"+
                  "    <label class='form-check-label' for='flexCheckDefault'>"+
                  "      Ofrecer como capítulo gratuito."+
                  "    </label>"+
                  "    </div>"+

                  " </div>"+
                  " </div>"+
                  " </div>";
        $("#accordionExampleM").append(div);
        $("#totalChaptersM").text(cuentaCap);
        
        if(cuentaCap!= 1){
            $('#removeChapterM').prop('disabled', false);
        }
    });

    
});

function addCategory(e){

    let cat = $(e).val();
    let category = cat.split(' ').join('-');
    let newId = "courseCategory" + category;
    if(category != ""){
    
    $("#error-categoryCourseC").slideUp(function(){
        let div = `
    <li id="${newId}" style="display:none;"> <strong class="cursor-pointer" onclick="showDescriptionCategory(this);">${cat}</strong>
    <a class="text-end" href="javascript:void(0)" onclick="showCategoryCB('${category}');">Eliminar</a>
    </li>
    `;
    $("#categories").append(div);
    $("#" + newId).slideDown();
    $("#cat-" + category).hide();
    $('#categoryBoxC').prop('selectedIndex', 0)
    });
    }
   

}

function addCategoryM(e){

    let cat = $(e).val();
    let category = cat.split(' ').join('-');
    let newId = "courseCategoryM" + category;
    if(category != ""){
    
    $("#error-categoryCourseM").slideUp(function(){
        let div = `
    <li id="${newId}" style="display:none;"> <strong class="cursor-pointer" onclick="showDescriptionCategory(this);">${cat}</strong>
    <a class="text-end" href="javascript:void(0)" onclick="showCategoryCBM('${category}');">Eliminar</a>
    </li>
    `;
    $("#categoriesM").append(div);
    $("#" + newId).slideDown();
    $("#catM-" + category).hide();
    $('#categoryBoxM').prop('selectedIndex', 0)
    });
    }
   

}

function showCategoryCB(e){
    $("#cat-" + e).show();
    $("#courseCategory" + e).slideUp(function(){
        $("#courseCategory" + e).remove();
    });
    
    //$("#cat-" + e).show();
}

function showCategoryCBM(e){
    $("#catM-" + e).show();
    $("#courseCategoryM" + e).slideUp(function(){
        $("#courseCategoryM" + e).remove();
    });
    
    //$("#cat-" + e).show();
}

function showDescriptionCategory(e){
    let category = $(e).text();
    $("#modal-title").text(category);
    $("#descriptionCategory").modal("show");

}

//////////////////////////////////////////////

function checkMoney(e, error){
    $(error).slideUp("fast");
    let letter_E = new RegExp("e");
    let m = $(e).val();
    if(m > 0 && !letter_E.test(m)){
        $(error).slideUp();
        return false;
    }
    else{
        $(error).slideDown();
        return true;
    }
}

function checkLength(e, error, l){
    $(error).slideUp("fast");
    let input = $(e).val();
    if(input.length > 0 && input.length < l){
        $(error).slideUp();
        return false;
    }
    else{
        $(error).slideDown();
        return true;
    }
}

function checkIsEmpty(e, error){
    $(error).slideUp("fast");
    
    
    let input = $(e).val();
    if(input != ""){
        $(error).slideUp();
        return false;
    }
    else{
        $(error).slideDown();
        return true;
    }
}
//////////////////////////////////////////////

function checkCategoriesCourse(){
    $("#error-categoryCourseC").slideUp("fast");
    let howMany = $('ol#categories li').length
    if(howMany != 0){
        $("#error-categoryCourseC").slideUp();
        return false;
    }
    else{
        $("#error-categoryCourseC").slideDown();
        return true;
    }
}

function checkCategoriesCourseM(){
    $("#error-categoryCourseM").slideUp("fast");
    let howMany = $('ol#categoriesM li').length
    if(howMany != 0){
        $("#error-categoryCourseM").slideUp();
        return false;
    }
    else{
        $("#error-categoryCourseM").slideDown();
        return true;
    }
}