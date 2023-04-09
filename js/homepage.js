/* File JavaScript che gestisce il comportamento dell'homepage */
$(function() {
    $(".elenco").hide();
    $(".headerLinkAdmin").hide();

    // Controlla quale utente è loggato e stampa un saluto
    $.ajax({
        url: "verifyAdmin.php",
        type: "POST",
        datatype: "json",
        success: verifyAdmin,
        error: ajaxFailed
    });

    // Visualizza l'elenco di tutte le auto
    $(".divImgAuto").click(function() {
        $.ajax({
            url: "showCars.php",
            type: "POST",
            datatype: "json",
            success: viewCars,
            error: ajaxFailed
        });
    });

    // Visualizza l'elenco di tutti i circuiti
    $(".divImgCircuiti").click(function() {
        $.ajax({
            url: "showTracks.php",
            type: "POST",
            datatype: "json",
            success: viewTracks,
            error: ajaxFailed
        });
    });

    // Visualizza l'elenco di tutte le recensioni
    $(".divImgRecensioni").click(function() {
        $.ajax({
            url: "showReviews.php",
            type: "POST",
            datatype: "json",
            success: viewReviews,
            error: ajaxFailed
        });
    });
});

// Funzione di callback quando la richiesta Ajax fallisce
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
    $("#treImg").hide();
    $(".elenco").show();
    $("h1").append("<h4>Ecco tutte le nostre auto</h4>");
    var i = 0;
    // Ciclo
    data.forEach(function(res) { 
        // Stampo tabella
        $("#list").append("<tr><th>Marchio</th>" +
                          "<th>Modello</th>" +
                          "<th>Anno</th>" +
                          "<th>Cavalli</th>" +
                          "<th>Prezzo</th>" +
                          "<th>Descrizione auto</th></tr>" +
                          "<tr><td>" + res.Marchio +
                          "</td><td>" + res.Modello +
                          "</td><td>" + res.Anno +
                          "</td><td>" + res.Cavalli +
                          "</td><td>" + res.Prezzo + "€/giro" +
                          "</td><td>" + res.Descrizione +
                          "</td><td>" + "<img src=../img/cars/car"+ i +".jpg class=imgjs></td></tr>");
                          i++;
    });
    // Link per tornare alla homepage
    $("#list:last-child").append("<p class=linkBackHome><a role=button>Torna alla Home</a></p>");

    $(".linkBackHome").click(function() {
        $("h4").remove();
        $("tr").remove();
        $(".linkBackHome").remove();
        $(".elenco").hide();
        $("#treImg").show();
    });
}

// Gestisce i valori di ritorno dello script showTracks.php
function viewTracks(data) {
    $("#treImg").hide();
    $(".elenco").show();
    $("h1").append("<h4>Ecco tutti i nostri circuiti</h4>");
    var i = 0;
    // Ciclo
    data.forEach(function(res) { 
        // Stampo tabella
        $("#list").append("<tr><th>Nome</th>" +
                          "<th>Città</th>" +
                          "<th>Lunghezza</th>" +
                          "<th>Numero di curve</th>" +
                          "<tr><td>" + res.Nome +
                          "</td><td>" + res.Città +
                          "</td><td>" + res.Lunghezza + "m" +
                          "</td><td>" + res.NumeroCurve +
                          "</td><td>" + "<img src=../img/tracks/track"+ i +".jpg class=imgjs></td></tr>");
                          i++; 
    });
    // Link per tornare alla homepage
    $("#list:last-child").append("<p class=linkBackHome><a role=button>Torna alla Home</a></p>");

    $(".linkBackHome").click(function() {
        $("h4").remove();
        $("tr").remove();
        $(".linkBackHome").remove();
        $(".elenco").hide();
        $("#treImg").show();
    });
}

// Gestisce i valori di ritorno dello script showReviews.php
function viewReviews(data) {
    $("#treImg").hide();
    $(".elenco").show();
    $("h1").append("<h4>Ecco tutte le recensioni</h4>");
    // Ciclo
    data.forEach(function(res) { 
        // Stampo tabella
        $("#list").append("<tr><th>Utente</th>" +
                          "<th>Circuito</th>" +
                          "<th>Auto</th>" +
                          "<th>Commento</th>" +
                          "<tr><td>" + res.Nome + " " + res.Cognome +
                          "</td><td>" + res.NomePista +
                          "</td><td>" + res.Marchio + " " + res.Modello +
                          "</td><td>" + res.Commento +
                          "</td><td>" + "<img src=../img/reviews/review"+ res.Grado +".jpg class=imgjs></td></tr>");
    });
    // Link per tornare alla homepage
    $("#list:last-child").append("<p class=linkBackHome><a role=button>Torna alla Home</a></p>");

    $(".linkBackHome").click(function() {
        $("h4").remove();
        $("tr").remove();
        $(".linkBackHome").remove();
        $(".elenco").hide();
        $("#treImg").show();
    });
}