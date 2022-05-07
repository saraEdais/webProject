$(document).ready(function () {
    function registerButtonHandel(success) {
        if (success) {
            $(".registerContainer").css("display", "none");
            $(".success").css("display", "flex");
        }
    };

    $('#myTab a[href="#home"]').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
      });
      $('#myTab a[href="#profile"]').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
      });
});
