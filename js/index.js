/* File JavaScript che gestisce il comportamento della pagina index */
$(function() {
    $("#logInSx > p").text("Vivi un'esperienza unica in pista");
    $(".logoutMex").hide();

    // Permette di visualizzare la password alla pressione continua del bottone
    $(".btnMostraNascondi").mousedown(function () {
        $("#logInDx [name=password]").attr("type","text");
        $(".btnMostraNascondi").attr("value","Nascondi password");
    });

    // Permette di oscurare la password al rilascio del bottone
    $(".btnMostraNascondi").mouseup(function () {
        $("#logInDx [name=password]").attr("type","password");
        $(".btnMostraNascondi").attr("value","Mostra password");
    });

    // Controlla l'URL per vedere se un utente si è scollegato e stampa "Logout effettuato con successo!"
    if(window.location.href === "http://localhost/progetto/index.php?logout") {
        $(".logoutMex").show();
        $(".logoutMex").text("Logout effettuato con successo!")
        $(".logoutMex").animate({opacity: '0'}, 3000); //scompare lentamente
    }

    // Alla pressione del bottone "Accedi" con una chimata Ajax controlla se i campi sono corretti e gestisce l'accesso
    $("#logInDx :submit").click(function() {
        if ($("#logInDx [type=email]")[0].reportValidity() && $("#logInDx [type=password]")[0].reportValidity()) {
            $.ajax({
                url: "php/access/logIn.php",
                type: "POST",
                datatype: "text",
                data: "email=" + $("#logInDx [type=email]").val() +
                      "&password=" + $("#logInDx [type=password]").val(),
                success: logIn,
                error: ajaxFailed
            });
        }
    });
});

// Funzione di callback quando la richiesta Ajax fallisce
function ajaxFailed(e) { 
    var errmessage = "Error making Ajax request:\n\n";

    errmessage += "Server status: \n" + e.status + "" + e.statusText
        + "\n\nServer response text:\n" + e.responseText;

    alert(errmessage);
}

// Gestione i valori di ritorno dello script logIn.php
function logIn(data) {
    if (data === "1") {
        window.open("http://localhost/progetto/php/homepage.php","_self");
    } else if (data === "0") {
        $("#logInDx [type=email]").val("");
        $("#logInDx [type=password]").val("");
        $("p.error").text("ATTENZIONE! Utente non trovato");
        $("#logInSx > p").text("Ops... Qualcosa è andato storto...");
    } else if (data === "-1") {
        $("#logInDx [type=email]").val("");
        $("#logInDx [type=password]").val("");
        $("p.error").text("ATTENZIONE! Formato dell'email e/o della password errato");
        $("#logInSx > p").text("Ops... Qualcosa è andato storto...");
    }
}