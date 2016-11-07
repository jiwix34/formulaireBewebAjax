// formulaire !!
$(function(){
    $("#contactForm").submit(function(event){
        var nom        = $("#nom").val();
        var email      = $("#email").val();
        var objet      = $("#objet").val();
        var message    = $("#message").val();
        var dataString = nom + email + message;
        var msg_all    = "Merci de remplir tous les champs";
        var msg_alert  = "Merci de remplir ce champs";

        if (dataString  == "") {
            $("#msg_all").html(msg_all);
        } else if (nom == "") {
            $("#msg_nom").html(msg_alert);
        } else if (email == "") {
            $("#msg_email").html(msg_alert);
        } else if (objet == "") {
            $("#msg_objet").html(msg_alert);
        } else if (message == "") {
            $("#msg_message").html(msg_alert);
        } else {
            $.ajax({
                type : "POST",
                url: $(this).attr("action"),
                data: $(this).serialize(),
                success : function() {
                    $("#confirm").text("Le message a bien été envoyé :)");
                },
                error: function() {
                    $("#confirm").text("Erreur, le message n'a pas été envoyé :(");
                }
            });
        }

        return false;
    });
});

// fonction pour vider les champs du formulaire
      $(function(){
      $(':input','#contactForm')
         .not(':button, :submit, :reset, :hidden')
         .val('')
         .removeAttr('checked')
         .removeAttr('selected');
});
