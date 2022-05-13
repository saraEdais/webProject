$(document).ready(function () {
    function registerButtonHandel(success) {
        if (success) {
            $(".registerContainer").css("display", "none");
            $(".success").css("display", "flex");
        }
    };

    //check if arrive messages from friends
    function messageNotification() {
        $.ajax({
            url: 'messageNotification.php',
            success: function (response) {
                if(response){
                $("#notification").css("color","#FF1111");
                }
            }
        });
    }
    setInterval(messageNotification,2000);
});
