<?php
    /* Script php per rimuovere un'auto dal database */
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once("../commonQuery.php");

        // Riprendo la sessione corrente
        session_start();
        
        $telaio = $_POST["telaio"];

        // Controlli sui campi
        if ($telaio === "") {
            print "-1";
            die();
        }
            
        $db = connection_db();

        $telaio = $db->quote($telaio);

        // Richiamo la query
        $rows = removeCar($telaio, $db);
    
        // Gestisco il valore di ritorno della query
        if (($rows->rowCount()) === 1)
            print "1";
        else
            print "0";
    }
?>