jQuery(function($){  

    var form = $("#send_message");

    $("#sendMsgBtn").on("click", function(event){
        event.preventDefault();

        var message = $(form).find("select[name='message']").val();
        var phone = $(form).find("input[name='phone_number']").val();

        console.log("message", message);
        console.log("phone", phone);
        
        if(message == '' ){
            alert("Select message from dropdown.");
            return false;
        }

        if(phone == '' ){
            alert("Enter Phone number.");
            return false;
        }

        // alert("submit");
        $(form).submit();

    });

}); 