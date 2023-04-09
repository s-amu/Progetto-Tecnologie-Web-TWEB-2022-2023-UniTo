<?php
    /* Script php per ricercare un utente e permettere l'accesso */
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once("../commonQuery.php");

        // Riprendo la sessione corrente
        session_start();

        // Controlli sui campi
        $email = strtolower($_POST["email"]);
        $password = $_POST["password"];

        $password = htmlspecialchars($password);
        
        if ((filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) == false ||
            (filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING)) == false) {
                print "-1";
                die();
        }

        $_SESSION["password"] = $password;
        $_SESSION["email"] = $email;
        
        $db = connection_db();
        $password = md5($password); //La funzione md5() calcola l'hash MD5 di una stringa
        $password = $db->quote($password);
        $email = $db->quote($email);
    
        // Richiamo la query
        $rows = searchUser($email, $password, $db);
        
        // Gestisco il valore di ritorno della query
        if (($rows->rowCount()) == 0) {
            print "0";
            die();
        } else if (($rows->rowCount()) == 1) {
            print "1";
        }
    }
?>