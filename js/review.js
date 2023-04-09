/* File JavaScript che gestisce il comportamento della pagina che permette di scrivere una recensione */
$(function() {
    $(".headerLinkAdmin").hide();

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
        success: viewReviewCars,
        error: ajaxFailed
    });

    // Permette di visualizzare in un menù a tendina tutte le piste
    $.ajax({
        url: "/progetto/php/showTracks.php",
        type: "POST",
        datatype: "json",
        success: viewReviewTracks,
        error: ajaxFailed
    });

    // Alla pressione del bottone "Invia Recensione" con una chimata Ajax controlla se i campi sono corretti e gestisce la recensione
    $(".btn").click(function() {
        $.ajax({
            url: "/progetto/php/user/addReview.php",
            type: "POST",
            datatype: "text",
            data: "marchio=" + $("#recensione [name=marchioAuto]").val() +
                  "&modello=" + $("#recensione [name=modelloAuto]").val() +
                  "&track=" + $("#recensione [name=circuito]").val() +
                  "&review=" + $("#recensione  textarea").val() +
                  "&degreePreference=" + $("#recensione [name=grad]:checked").val() +
                  "&data=" + $("#recensione [name=data]").val() +
                  "&ora=" + $("#recensione [name=ora]").val(),
            success: sendReview,
            error: ajaxFailed
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
function viewReviewCars(data) {
    data.forEach(function(res) {
        $("#recensione [name=marchioAuto]").append("<option>" + res.Marchio + "</option>");
        $("#recensione [name=modelloAuto]").append("<option>" + res.Modello + "</option>");
    });
}

// Gestisce i valori di ritorno dello script showTracks.php
function viewReviewTracks(data) {
    data.forEach(function(res) {
        $("#recensione [name=circuito]").append("<option>" + res.Nome + "</option>");
    });
}

// Gestisce i valori di ritorno dello script addReview.php
function sendReview(data) {
    if (data == "1") {
        $(".error").hide();
        $("h1").append("<p class=modifyReservationMex>Recensione inviata con successo!</p>");
        $("h1 > p").animate({opacity: '0'}, 3000, function() {
            $("h1 > p").remove();
        });
    } else if (data == "0") {
        $(".error").show();
        $(".error").text("ATTENZIONE! C'è stato un errore, riprova!");
    } else if (data == "-1") {
        $(".error").show();
        $(".error").text("ATTENZIONE! L'auto scelta non è valida, riprova!");
    } else if (data == "-2") {
        $(".error").show();
        $(".error").text("ATTENZIONE! Il grado di preferenza scelto non è valido, riprova!");
    } else if (data == "-3") {
        $(".error").show();
        $(".error").text("ATTENZIONE! Il circuito scelto non è valido, riprova!");
    }  else if (data == "-4") {
        $(".error").show();
        $(".error").text("ATTENZIONE! Compila tutti i campi!");
    }  else if (data == "-5") {
        $(".error").show();
        $(".error").text("ATTENZIONE! La recensione fa riferimento ad una prenotazione inesistente, riprova!");
    }
}