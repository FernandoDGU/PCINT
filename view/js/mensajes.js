$(document).ready(function(){
    $("#sendMessage").click(function(){
        text = $("#txta-message").val();
        if(text != ""){
        let d = new Date();
        let month = d.getMonth()+1;
        let day = d.getDate();
        let date = (day<10 ? '0' : '') + day + '/' +
        (month<10 ? '0' : '') + month + '/' +
         d.getFullYear();
        let time = (d.getHours()<10 ? '0' : '') + d.getHours() + ':' +
        (d.getMinutes()<10 ? '0' : '') + d.getMinutes();
        
        
        let div = `
            <div class="col-12 text-center">
                <small>${date} - ${time}</small>
            </div>
            <div class="col-lg-7 col-9 ms-auto d-flex">
                <div class="messages ms-auto" style="background-color: rgba(130, 216, 219, 0.596);">${text}</div>
            </div>
            <br>
        `;
        $('#messageHistory').append(div);
        $("#txta-message").val("");
    }
    });


        
});