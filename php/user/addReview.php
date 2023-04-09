<?php
    /* Script php per aggiungere una recensione al database */
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once("../commonQuery.php");

        // Riprendo la sessione corrente
        session_start();
        $email = $_SESSION["email"];

        $marchio = $_POST["marchio"];
        $modello = $_POST["modello"];
        $track = $_POST["track"];
        $review = $_POST["review"];
        $degreePreference = $_POST["degreePreference"];
        $data = $_POST["data"];
        $ora = $_POST["ora"];

        // Controlli sui campi
        $review = htmlspecialchars($review);

        if ($degreePreference !== "1" && $degreePreference !== "2" &&
            $degreePreference !== "3") {
                print "-2";
                die();
        }

        if ($marchio === "" || $modello === "" || $track === "" ||
            $review === "" || $degreePreference === "") {
                print "-4";
                die();
        }

        if ((filter_input(INPUT_POST, "marchio", FILTER_SANITIZE_STRING)) == false ||
            (filter_input(INPUT_POST, "modello", FILTER_SANITIZE_STRING)) == false ||
            (filter_input(INPUT_POST, "track", FILTER_SANITIZE_STRING)) == false || 
            (filter_input(INPUT_POST, "review", FILTER_SANITIZE_STRING)) == false ||
            (filter_input(INPUT_POST, "degreePreference", FILTER_SANITIZE_NUMBER_INT)) == false) {
                print "0";
                die();
        }

        $db = connection_db();

        $email = $db->quote($email);
        $marchio = $db->quote($marchio);
        $modello = $db->quote($modello);
        $track = $db->quote($track);
        $review = $db->quote($review);
        $degreePreference = $db->quote($degreePreference);
        $data = $db->quote($data);
        $ora = $db->quote($ora);

        header("Content-type: application/json");

        // Richiamo la query
        $rowsCar = returnNumTelaio($marchio, $modello, $db);

        // Gestisco il valore di ritorno della query
        if (($rowsCar->rowCount()) === 0) {
            print "-1";
            die();
        }

        // Richiamo la query
        $rowsTrack = returnIDtrack($track, $db);

        // Gestisco il valore di ritorno della query
        if (($rowsTrack->rowCount()) === 0) {
            print "-3";
            die();
        }

        // Richiamo la query
        $rowsVerifyReview = searchReservation($marchio, $modello, $track, $data, $ora, $email, $db);
        
        // Gestisco il valore di ritorno della query
        if (($rowsVerifyReview->rowCount()) === 0) {
            print "-5";
            die();
        }

        // Richiamo la query
        $rows = insertReview($email, $marchio, $modello, $track, $review, $degreePreference, $db);

        // Gestisco il valore di ritorno della query
        if (($rows->rowCount()) === 1)
            print "1";
        else
            print "0";
    }
?>