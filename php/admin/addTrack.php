<?php
    /* Script php per aggiungere una pista al database */
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once("../commonQuery.php");

        // Riprendo la sessione corrente
        session_start();

        $nome = $_POST["nome"];
        $citta = $_POST["citta"];
        $lunghezza = $_POST["lunghezza"];
        $numeroCurve = $_POST["numeroCurve"];

        // Controlli sui campi
        if ($nome === "" || $citta === "" || $lunghezza === "" || $numeroCurve === "") {
            print "-1";
            die();
        }

        $db = connection_db();

        $nome = $db->quote($nome);
        $citta = $db->quote($citta);
        $lunghezza = $db->quote($lunghezza);
        $numeroCurve = $db->quote($numeroCurve);

        // Richiamo la query
        $rows = insertTrack($nome, $citta, $lunghezza, $numeroCurve, $db); //eseguo la query
    
        // Gestisco il valore di ritorno della query
        if (($rows->rowCount()) === 1)
            print "1";
        else
            print "0";
    }
?>