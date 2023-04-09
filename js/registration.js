/* File JavaScript che gestisce il comportamento della pagina di registrazione */
$(function() {
    $("#regSx > p").text("Vivi un'esperienza unica in pista... Ma prima registrati");

    // Permette di visualizzare la password alla pressione continua del bottone
    $(".btnMostraNascondi").mousedown(function() {
        $("#regDx [name=password]").attr("type","text");
        $(".btnMostraNascondi").attr("value","Nascondi password");
    });

    // Permette di oscurare la password al rilascio del bottone
    $(".btnMostraNascondi").mouseup(function() {
        $("#regDx [name=password]").attr("type","password");
        $(".btnMostraNascondi").attr("value","Mostra password");
    });

    $("#hover").hide();

    // Visualizza il testo che dice come impostare la password
    $("#regDx [name=password]").mouseenter(function() {
        $("#hover").show();
    });

    // Nasconde il testo che dice come impostare la password
    $("#regDx [name=password]").mouseleave(function() {
        $("#hover").hide();
    });

    // Pulisce tutti i campi alla pressione del tasto "Reimposta"
    $("#regDx :reset").click(function() {
        $("#regDx [name=name]").val("");
        $("#regDx [name=surname]").val("");
        $("#regDx [name=CF]").val("");
        $("#regDx [name=sesso]").val("");
        $("#regDx [name=date]").val("");
        $("#regDx [name=email]").val("");
        $("#regDx [name=password]").val("");
    });

    // Alla pressione del bottone "Registrati" con una chimata Ajax controlla se i campi sono corretti e gestisce la registrazione
    $("#regDx :submit").click(function() {
        if ($("#regDx [type=text]")[0].reportValidity() && $("#regDx [type=text]")[1].reportValidity() && 
            $("#regDx [type=text]")[2].reportValidity() && $("#regDx [type=radio]")[0].reportValidity() &&
            $("#regDx [type=date]")[0].reportValidity() && $("#regDx [type=email]")[0].reportValidity() &&
            $("#regDx [type=password]")[0].reportValidity() && $("#regDx [type=text]")[0].reportValidity()) {
                $.ajax({
                    url: "/progetto/php/registration/subscription.php",
                    type: "POST",
                    datatype: "text",
                    data: "name=" + $("#regDx [name=name]").val() +
                          "&surname=" + $("#regDx [name=surname]").val() +
                          "&CF=" + $("#regDx [name=CF]").val() +
                          "&sesso=" + $("#regDx [name=sesso]:checked").val() +
                          "&date=" + $("#regDx [name=date]").val() +
                          "&email=" + $("#regDx [name=email]").val() +
                          "&password=" + $("#regDx [name=password]").val() +
                          "&admin=0",
                    success: registration,
                    error: ajaxFailed
                });
        }
    });
});

// Funzione di callback quando la richiesta ajax fallisce
function ajaxFailed(e) { 
    var errmessage = "Error making Ajax request:\n\n";

    errmessage += "Server status: \n" + e.status + " " + e.statusText
        + "\n\nServer response text:\n" + e.responseText;

    alert(errmessage);
}

// Gestisce i valori di ritorno dello script subscription.php
function registration(data) {
    if (data === "1") {
        window.open("http://localhost/progetto/php/homepage.php","_self");
    } else if (data === "0") {
        $("#regDx [name=name]").val("");
        $("#regDx [name=surname]").val("");
        $("#regDx [name=CF]").val("");
        $("#regDx [name=date]").val("");
        $("#regDx [name=email]").val("");
        $("#regDx [name=password]").val("");
        $("p.error").text("ATTENZIONE! Il formato di uno o più campi è errato");
        $("#regSx > p").text("Ops... Qualcosa è andato storto...");
    } else if (data === "-1") {
        $("#regDx [name=CF]").val("");
        $("p.error").text("ATTENZIONE! Questo codice fiscale è già in uso");
        $("#regSx > p").text("Ops... Qualcosa è andato storto...");
    } else if (data === "-2") {
        $("#regDx [name=name]").val("");
        $("#regDx [name=surname]").val("");
        $("#regDx [name=CF]").val("");
        $("#regDx [name=date]").val("");
        $("#regDx [name=email]").val("");
        $("#regDx [name=password]").val("");
        $("p.error").text("ATTENZIONE! La registrazione non è andata a buon fine");
        $("#regSx > p").text("Ops... Qualcosa è andato storto...");
    } else if (data === "-3") {
        $("#regDx [name=email]").val("");
        $("p.error").text("ATTENZIONE! Questa email è già in uso");
        $("#regSx > p").text("Ops... Qualcosa è andato storto...");
    }
}