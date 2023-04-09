<?php
    /* Script php per aggiungere un'auto al database */
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once("../commonQuery.php");

        // Riprendo la sessione corrente
        session_start();

        $telaio = $_POST["telaio"];
        $marchio = $_POST["marchio"];
        $modello = $_POST["modello"];
        $anno = $_POST["anno"];
        $cavalli = $_POST["cavalli"];
        $prezzo = $_POST["prezzo"];
        $descrizione = $_POST["descrizione"];

        // Controlli sui campi
        if ($telaio === "" || $marchio === "" || $modello === "" || $anno === "" || $cavalli === "" ||
            $prezzo === "" || $descrizione === "") {
                print "-1";
                die();
        }

        $db = connection_db();

        $telaio = $db->quote($telaio);
        $marchio = $db->quote($marchio);
        $modello = $db->quote($modello);
        $anno = $db->quote($anno);
        $cavalli = $db->quote($cavalli);
        $prezzo = $db->quote($prezzo);
        $descrizione = $db->quote($descrizione);

        // Richiamo la query
        $rows = insertCar($telaio, $marchio, $modello, $anno, $cavalli, $prezzo, $descrizione, $db); //eseguo la query
    
        // Gestisco il valore di ritorno della query
        if (($rows->rowCount()) === 1)
            print "1";
        else
            print "0";
    }
?>