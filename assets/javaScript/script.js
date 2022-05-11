$(document).ready(function () {
    function registerButtonHandel(success) {
        if (success) {
            $(".registerContainer").css("display", "none");
            $(".success").css("display", "flex");
        }
    };
});
