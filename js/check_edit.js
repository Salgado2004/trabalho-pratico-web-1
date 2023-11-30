$(function () {
    $("#edit").on("submit", function () {
      email_input = $("input[name='nome']");
      email_input = $("input[name='email']");
      if (email_input.val() == "" || email_input.val() == null) {
        $("#erro-input").html("O nome é obrigatorio");
      }
      else if (email_input.val() == "" || email_input.val() == null) {
        $("#erro-input").html("O email é obrigatorio");
      }
    });
  });