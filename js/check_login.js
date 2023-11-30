$(function () {
  $("#login").on("submit", function () {
    email_input = $("input[name='email-log']");
    senha_input = $("input[name='senha-log']");
    if (email_input.val() == "" || email_input.val() == null) {
      window.location.href = "signup.php?el=1";
    }
    else if (senha_input.val() == "" || senha_input.val() == null) {
      window.location.href = "signup.php?el=3";
    }
    return (true);
  });
});