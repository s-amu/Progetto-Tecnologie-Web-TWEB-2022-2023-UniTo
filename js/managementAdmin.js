/* File JavaScript che gestisce il comportamento della pagina riservata all'amministratore */
$(function() {
    $(".headerLinkAdmin").show();

    // Controlla quale utente è loggato e stampa un saluto
    $.ajax({
        url: "/progetto/php/verifyAdmin.php",
        type: "POST",
        datatype: "json",
        success: verifyAdmin,
        error: ajaxFailed
    });

    // Rimuove i 4 bottoni dallo schermo e crea il form per l'inserimento di una nuova auto nel database
    $(".btnAddAuto").click(function () { 
        $(".btnDelAuto").hide();
        $(".btnAddPiste").hide();
        $(".btnDelPiste").hide();
        $(".btnAddAuto").hide();
        $("h1").hide();
        $("#gestione").append("<h2 id=titolo>Inserisci i dettagli dell'auto da aggiungere</h2>" +
        "<p id=label><label>Numero di telaio:</label> "+
        "<input type=text placeholder=Telaio name=telaio autofocus=autofocus required></p>" +
        "<p id=label><label>Marchio:</label> " +
        "<input type=text placeholder=Marchio name=marchio required></p>" +
        "<p id=label><label>Modello:</label> " +
        "<input type=text placeholder=Modello name=modello required></p>" +
        "<p id=label><label>Anno di produzione:</label> " +
        "<input type=text placeholder=Anno name=anno required></p>" +
        "<p id=label><label>Cavalli:</label> " +
        "<input type=text placeholder=Cavalli name=cavalli required></p>" +
        "<p id=label><label>Prezzo per giro:</label> " +
        "<input type=text placeholder=Prezzo name=prezzo required></p>" +
        "<p id=label><label>Descrizione:</label></p>" +
        "<p><textarea rows=5 cols=99 name=descrizione required></textarea></p>" +
        "<p class=error></p>" +
        "<p><input class=btn type=button value=Aggiungi></p>" +
        "<p class=linkBackHome><a role=button>Torna alla gestione</a></p>");

        // Premuto il bottone "Aggiungi", con una chimata Ajax si aggiunge l'auto al database
        $(".btn").click(function () { 
            $.ajax({
                url: "/progetto/php/admin/addCar.php",
                type: "POST",
                datatype: "text",
                data: "telaio=" + $("#gestione [name=telaio]").val() +
                "&marchio=" + $("#gestione [name=marchio]").val() +
                "&modello=" + $("#gestione [name=modello]").val() +
                "&anno=" + $("#gestione [name=anno]").val() +
                "&cavalli=" + $("#gestione [name=cavalli]").val() +
                "&prezzo=" + $("#gestione [name=prezzo]").val() +
                "&descrizione=" + $("#gestione [name=descrizione]").val(),
                success: addCar,
                error: ajaxFailed
            });
        });

        // Alla pressione del link "Torna alla gestione" rimuove il form e mostra i 4 bottoni
        $(".linkBackHome").click(function() {
            $("h1").show();
            $(".btnDelAuto").show();
            $(".btnAddPiste").show();
            $(".btnDelPiste").show();
            $(".btnAddAuto").show();
            $(".linkBackHome").hide();
            $("#titolo").remove();
            $i = 0;
            while ($i < 7) {
                $("#label").remove();
                $i++;
            }
            $("#gestione [name=descrizione]").remove();
            $(".error").remove();
            $(".btn").remove();
        });
    });

    // Rimuove i bottoni dallo schermo e crea il form per la rimozione di un auto dal database
    $(".btnDelAuto").click(function () { 
        $(".btnDelAuto").hide();
        $(".btnAddPiste").hide();
        $(".btnDelPiste").hide();
        $(".btnAddAuto").hide();
        $("h1").hide();
        $("#gestione").append("<h2 id=titolo>Inserisci il numero di telaio dell'auto da eliminare</h2>" +
        "<p id=label><label>Numero di telaio:</label> "+
        "<input type=text placeholder=Telaio name=telaio autofocus=autofocus required></p>" +
        "<p class=error></p>" +
        "<p><input class=btn type=button value=Elimina></p>" +
        "<p class=linkBackHome><a role=button>Torna alla gestione</a></p>");

        // Premuto il bottone "Elimina", con una chimata Ajax si rimuove l'auto dal database
        $(".btn").click(function () { 
            $.ajax({
                url: "/progetto/php/admin/removeCar.php",
                type: "POST",
                datatype: "text",
                data: "telaio=" + $("#gestione [name=telaio]").val(),
                success: removeCar,
                error: ajaxFailed
            });
        });

        // Alla pressione del link "Torna alla gestione" rimuove il form e mostra i 4 bottoni
        $(".linkBackHome").click(function() {
            $("h1").show();
            $(".btnDelAuto").show();
            $(".btnAddPiste").show();
            $(".btnDelPiste").show();
            $(".btnAddAuto").show();
            $(".linkBackHome").hide();
            $("#titolo").remove();
            $("#label").remove();
            $(".error").remove();
            $(".btn").remove();
        });
    });

    // Rimuove i 4 bottoni dallo schermo e crea il form per l'inserimento di una nuova pista nel database
    $(".btnAddPiste").click(function () { 
        $(".btnDelAuto").hide();
        $(".btnAddPiste").hide();
        $(".btnDelPiste").hide();
        $(".btnAddAuto").hide();
        $("h1").hide();
        $("#gestione").append("<h2 id=titolo>Inserisci i dettagli della pista da aggiungere</h2>" +
        "<p id=label><label>Nome:</label> "+
        "<input type=text placeholder=Nome name=nome autofocus=autofocus required></p>" +
        "<p id=label><label>Città:</label> " +
        "<input type=text placeholder=Città name=citta required></p>" +
        "<p id=label><label>Lunghezza:</label> " +
        "<input type=text placeholder=Lunghezza name=lunghezza required></p>" +
        "<p id=label><label>Numero di curve:</label> " +
        "<input type=text placeholder=Curve name=curve required></p>" +
        "<p class=error></p>" +
        "<p><input class=btn type=button value=Aggiungi></p>" +
        "<p class=linkBackHome><a role=button>Torna alla gestione</a></p>");

        // Premuto il bottone "Aggiungi", con una chimata Ajax si aggiunge la pista al database
        $(".btn").click(function () { 
            $.ajax({
                url: "/progetto/php/admin/addTrack.php",
                type: "POST",
                datatype: "text",
                data: "nome=" + $("#gestione [name=nome]").val() +
                "&citta=" + $("#gestione [name=citta]").val() +
                "&lunghezza=" + $("#gestione [name=lunghezza]").val() +
                "&numeroCurve=" + $("#gestione [name=curve]").val(),
                success: addTrack,
                error: ajaxFailed
            });
        });

        // Alla pressione del link "Torna alla gestione" rimuove il form e mostra i 4 bottoni
        $(".linkBackHome").click(function() {
            $("h1").show();
            $(".btnDelAuto").show();
            $(".btnAddPiste").show();
            $(".btnDelPiste").show();
            $(".btnAddAuto").show();
            $(".linkBackHome").hide();
            $("#titolo").remove();
            $i = 0;
            while ($i < 4) {
                $("#label").remove();
                $i++;
            }
            $(".error").remove();
            $(".btn").remove();
        });
    });

    // Rimuove i bottoni dallo schermo e crea il form per la rimozione di una pista dal database
    $(".btnDelPiste").click(function () { 
        $(".btnDelAuto").hide();
        $(".btnAddPiste").hide();
        $(".btnDelPiste").hide();
        $(".btnAddAuto").hide();
        $("h1").hide();
        $("#gestione").append("<h2 id=titolo>Inserisci l'ID della pista da eliminare</h2>" +
        "<p id=label><label>ID:</label> "+
        "<input type=text placeholder=ID name=id autofocus=autofocus required></p>" +
        "<p class=error></p>" +
        "<p id=a><input class=btn type=button value=Elimina></p>" +
        "<p class=linkBackHome><a role=button>Torna alla gestione</a></p>");

        // Premuto il bottone "Elimina", con una chimata Ajax si rimuove la pista dal database
        $(".btn").click(function () { 
            $.ajax({
                url: "/progetto/php/admin/removeTrack.php",
                type: "POST",
                datatype: "text",
                data: "id=" + $("#gestione [name=id]").val(),
                success: removeTrack,
                error: ajaxFailed
            });
        });

        // Alla pressione del link "Torna alla gestione" rimuove il form e mostra i 4 bottoni
        $(".linkBackHome").click(function() {
            $("h1").show();
            $(".btnDelAuto").show();
            $(".btnAddPiste").show();
            $(".btnDelPiste").show();
            $(".btnAddAuto").show();
            $(".linkBackHome").hide();
            $("#titolo").remove();
            $("#label").remove();
            $(".error").remove();
            $(".btn").remove();
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
        $("#welcome").text("Ciao " + res.Nome);
    });
}

// Gestisce i valori di ritorno dello script addCar.php
function addCar(data) { 
    if (data === "1") {
        $(".error").hide();
        $("#titolo").append("<p class=modifyAdminMex>Auto aggiunta con successo!</p>");
        $("#titolo > p").animate({opacity: '0'}, 3000, function() {
            $("#titolo > p").remove();
        }); 
    } else if (data === "0") {
        $(".error").show();
        $(".error").text("ATTENZIONE! C'è stato un errore, riprova!");
    } else if (data === "-1") {
        $(".error").show();
        $(".error").text("ATTENZIONE! Compila tutti i campi!");
    }
}

// Gestisce i valori di ritorno dello script addTrack.php
function addTrack(data) { 
    if (data === "1") {
        $(".error").hide();
        $("#titolo").append("<p class=modifyAdminMex>Pista aggiunta con successo!</p>");
        $("#titolo > p").animate({opacity: '0'}, 3000, function() {
            $("#titolo > p").remove();
        });
    } else if (data === "0") {
        $(".error").show();
        $(".error").text("ATTENZIONE! C'è stato un errore, riprova!");
    } else if (data === "-1") {
        $(".error").show();
        $(".error").text("ATTENZIONE! Compila tutti i campi!");
    }
}

// Gestisce i valori di ritorno dello script removeCar.php
function removeCar(data) {
    if (data === "1") {
        $(".error").hide();
        $("#titolo").append("<p class=modifyAdminMex>Auto rimossa con successo!</p>");
        $("#titolo > p").animate({opacity: '0'}, 3000, function() {
            $("#titolo > p").remove();
        });
    } else if (data === "0") {
        $(".error").show();
         $(".error").text("ATTENZIONE! Auto inesistente, riprova!");
    } else if (data === "-1") {
        $(".error").show();
        $(".error").text("ATTENZIONE! Compila il campo!");
    }
}

// Gestisce i valori di ritorno dello script removeTrack.php
function removeTrack(data) {
    if (data === "1") {
        $(".error").hide();
        $("#titolo").append("<p class=modifyAdminMex>Pista rimossa con successo!</p>");
        $("#titolo > p").animate({opacity: '0'}, 3000, function() {
            $("#titolo > p").remove();
        });
    } else if (data === "0") {
        $(".error").show();
        $(".error").text("ATTENZIONE! Pista inesistente, riprova!");
    } else if (data === "-1") {
        $(".error").show();
        $(".error").text("ATTENZIONE! Compila il campo!");
    }
}