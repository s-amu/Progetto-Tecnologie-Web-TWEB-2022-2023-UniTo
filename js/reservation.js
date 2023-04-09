/* File JavaScript che gestisce il comportamento della pagina di prenotazione di una corsa */
$(function() {
    $(".headerLinkAdmin").hide();
    $("#fortuna").hide();

    // Controlla quale utente è loggato e stampa un saluto
    $.ajax({
        url: "/progetto/php/verifyAdmin.php",
        type: "POST",
        datatype: "json",
        success: verifyAdmin,
        error: ajaxFailed
    });

    // Permette di visualizzare in un menù a tendina tutte le auto
    $.ajax({
        url: "/progetto/php/showCars.php",
        type: "POST",
        datatype: "json",
        success: viewCars,
        error: ajaxFailed
    });

    // Permette di visualizzare in un menù a tendina tutte le piste
    $.ajax({
        url: "/progetto/php/showTracks.php",
        type: "POST",
        datatype: "json",
        success: viewTracks,
        error: ajaxFailed
    });

    // Alla pressione del bottone "Prenota" con una chimata Ajax controlla se i campi sono corretti e gestisce la prenotazione
    $("[type=submit]").click(function () { 
        $.ajax({
            url: "/progetto/php/user/addReservation.php",
            type: "POST",
            datatype: "text",
            data: "marchio=" + $("#prenotazione [name=marchioAuto]").val() +
                  "&modello=" + $("#prenotazione [name=modelloAuto]").val() +
                  "&pista=" + $("#prenotazione [name=pista]").val() +
                  "&data=" + $("#prenotazione [name=data]").val() +
                  "&ora=" + $("#prenotazione [name=ora]").val(),
            success: addReservation,
            error: ajaxFailed
        });
    });

    // Alla pressione del bottone "Tenta la fortuna", con un'animazione il bottone scompare e viene visualizzato randomicamente un premio
    $("[type=button]").click(function () {
        var array = ["Che peccato, questa volta è andata male...", "Che fortuna, hai il 15% di sconto su questa prenotazione!!!",
        "Che fortuna, hai ricevuto DUE giri in omaggio!!!", "Che peccato, questa volta è andata male...", 
        "Che fortuna, hai ricevuto UN giro in omaggio!!!", "Che fortuna, hai il 20% di sconto su questa prenotazione!!!"];
        $("[type=button]").animate({opacity: '0'}, 2000, function() {
            $("#fortuna").show();
            $("#fortuna").text(array[Math.floor(Math.random() * 6)]);
            $("[type=button]").hide();
        });
    });
});

// Funzione di callback quando la richiesta ajax fallisce
function ajaxFailed(e) { 
    var errmessage = "Error making Ajax request:\n\n";

    errmessage += "Server status: \n" + e.status + "" + e.statusText
        + "\n\nServer response text:\n" + e.responseText;

    alert(errmessage);
}

// Mostra il saluto all'utente
function verifyAdmin(data) {
    data.forEach(function(res) { 
        if (res.Admin === 1)
            $(".headerLinkAdmin").show();
        else
            $(".headerLinkAdmin").remove();
        
        $("#welcome").text("Ciao " + res.Nome);
    });
}

// Gestisce i valori di ritorno dello script showCars.php
function viewCars(data) {
    data.forEach(function(res) {
        $("#prenotazione [name=marchioAuto]").append("<option>" + res.Marchio + "</option>");
        $("#prenotazione [name=modelloAuto]").append("<option>" + res.Modello + "</option>");
    });
}

// Gestisce i valori di ritorno dello script showTracks.php
function viewTracks(data) {
    data.forEach(function(res) {
        $("#prenotazione [name=pista]").append("<option>" + res.Nome + "</option>");
    });
}

// Gestisce i valori di ritorno dello script addReservation.php
function addReservation(data) {
    if (data === "1") {
        $(".error").hide();
        $("h1").append("<p class=modifyReservationMex>Prenotazione effettuata con successo!</p>");
        $("h1 > p").animate({opacity: '0'}, 3000, function() {
            $("h1 > p").remove();
        });
    } else if (data === "0") {
        $(".error").show();
        $(".error").text("ATTENZIONE! C'è stato un errore, riprova!");
    } else if (data === "-1") {
        $(".error").show();
        $(".error").text("ATTENZIONE! La data scelta non è valida, riprova!");
    } else if (data === "-2") {
        $(".error").show();
        $(".error").text("ATTENZIONE! L'orario scelto non è valido, riprova!");
    } else if (data === "-3") {
        $(".error").show();
        $(".error").text("ATTENZIONE! È già presente questa prenotazione, riprova!");
    }  else if (data === "-4") {
        $(".error").show();
        $(".error").text("ATTENZIONE! L'auto scelta non è valida, riprova!");
    } else if (data === "-5") {
        $(".error").show();
        $(".error").text("ATTENZIONE! Compila tutti i campi!");
    } else if (data === "-6") {
        $(".error").show();
        $(".error").text("ATTENZIONE! Il circuito scelto non è valido, riprova!");
    }
}