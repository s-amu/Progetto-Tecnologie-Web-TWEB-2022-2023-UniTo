<?php
    /* Script php per mostrare i dati di un certo utente nel database */
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once("commonQuery.php");
        
        // Riprendo la sessione corrente
        session_start();
        $email = $_SESSION["email"];

        $db = connection_db();
        $email = $db->quote($email);

        header("Content-type: application/json");

        // Richiamo la query
        $rows = verifyAdmin($email, $db);

        // Gestisco il valore di ritorno della query
        $viewAll = array();
        $res = $rows->fetchAll();
        foreach ($res as $row) {
            $viewAll[] = $row;
        }
        print json_encode($viewAll);
    }
?>