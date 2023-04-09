<?php
    /* Script php per aggiungere una prenotazione al database */
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once("../commonQuery.php");

        // Riprendo la sessione corrente
        session_start();
        $email = $_SESSION["email"];

        $marchio = $_POST["marchio"];
        $modello = $_POST["modello"];
        $pista = $_POST["pista"];
        $data = $_POST["data"];
        $ora = $_POST["ora"];
        
        // Controlli sui campi
        if ($marchio === "" || $modello === "" || $pista === "" || 
            $data === "" || $ora === "") {
                print "-5";
                die();
        }

        if ($data <= (date('Y-m-d'))) {
            print "-1";
            die();
        }

        if ($ora !== "09:00" && $ora !== "10:00" && $ora !== "11:00" &&
            $ora !== "12:30" && $ora !== "13:30" && $ora !== "14:30" &&
            $ora !== "15:30") {
                print "-2";
                die();
        }
        
        if ((filter_input(INPUT_POST, "marchio", FILTER_SANITIZE_STRING)) == false ||
            (filter_input(INPUT_POST, "modello", FILTER_SANITIZE_STRING)) == false ||
            (filter_input(INPUT_POST, "pista", FILTER_SANITIZE_STRING)) == false || 
            (filter_input(INPUT_POST, "data", FILTER_SANITIZE_STRING)) == false ||
            (filter_input(INPUT_POST, "ora", FILTER_SANITIZE_STRING)) == false) {
                print "0";
                die();
        }

        $db = connection_db();

        $marchio = $db->quote($marchio);
        $modello = $db->quote($modello);
        $pista = $db->quote($pista);
        $data = $db->quote($data);
        $ora = $db->quote($ora);
        $email = $db->quote($email);

        // Richiamo la query
        $rowsCar = returnNumTelaio($marchio, $modello, $db);

        // Gestisco il valore di ritorno della query
        if (($rowsCar->rowCount()) === 0) {
            print "-4";
            die();
        }

        // Richiamo la query
        $rowsTrack = returnIDtrack($pista, $db);

        // Gestisco il valore di ritorno della query
        if (($rowsTrack->rowCount()) === 0) {
            print "-6";
            die();
        }

        // Richiamo la query
        $rowsRes = searchReservation($marchio, $modello, $pista, $data, $ora, $email, $db);

        // Gestisco il valore di ritorno della query
        if (($rowsRes->rowCount()) !== 0) {
            print "-3";
            die();
        } else if (($rowsRes->rowCount()) === 0) {
            $rowsIns = insertReservation($marchio, $modello, $pista, $data, $ora, $email, $db);
            if (($rowsIns->rowCount()) === 1)
                print "1";
            else
                print "0";
        }
    }
?>