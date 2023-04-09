<?php
    /* Script php per rimuovere una pista dal database */
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once("../commonQuery.php");

        // Riprendo la sessione corrente
        session_start();
        
        $id = $_POST["id"];

        // Controlli sui campi
        if ($id === "") {
            print "-1";
            die();
        }
        
        $db = connection_db();

        $id = $db->quote($id);

        // Richiamo la query
        $rows = removeTrack($id, $db);

        // Gestisco il valore di ritorno della query
        if (($rows->rowCount()) === 1)
            print "1";
        else
            print "0";
    }
?>