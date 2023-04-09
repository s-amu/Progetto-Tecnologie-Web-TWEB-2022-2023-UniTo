<?php
    /* Script php per mostrare tutte le piste nel database */
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once("commonQuery.php");

        // Riprendo la sessione corrente
        session_start();
        
        $db = connection_db();
        
        header("Content-type: application/json");

        // Richiamo la query
        $rows = viewTable("tracks", $db);

        // Gestisco il valore di ritorno della query
        $viewAll = array();
        $res = $rows->fetchAll();
        foreach ($res as $row) {
            $viewAll[] = $row;
        }
        print json_encode($viewAll);
    }
?>