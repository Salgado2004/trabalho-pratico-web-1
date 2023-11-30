$(function () {
    $("#login").on("submit", function () {
        nome_input = $("input[name='nome-cad']");
        email_input = $("input[name='email-cad']");
        senha_input = $("input[name='senha-cad']");
        confirm_input = $("input[name='senha-confirm']");
        if (nome_input.val() == "" || nome_input.val() == null) {
            window.location.href = "signup.php?el=6";
        } else if (email_input.val() == "" || email_input.val() == null) {
            window.location.href = "signup.php?el=1";
        } else if (senha_input.val() == "" || senha_input.val() == null) {
            window.location.href = "signup.php?el=3";
        } else if (confirm_input.val() == "" || confirm_input.val() == null) {
            window.location.href = "signup.php?el=4";
        } else if (senha_input.val() != confirm_input.val()) {
            window.location.href = "signup.php?el=8";
        }
    });
});