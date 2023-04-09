<?php
    /* Script php per gestire la registrazione di un utente al sito */
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once("../commonQuery.php");
        
        // Riprendo la sessione corrente
        session_start();

        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $CF = strtoupper($_POST["CF"]);
        $sesso = $_POST["sesso"];
        $date = $_POST["date"];
        $email = strtolower($_POST["email"]);
        $password = $_POST["password"];
        $admin = $_POST["admin"];

        // Controlli sui campi
        $name = htmlspecialchars($name);
        $surname = htmlspecialchars($surname);
        $CF = htmlspecialchars($CF);
        $password = htmlspecialchars($password);

        if ((filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING)) == false ||
            (filter_input(INPUT_POST, "surname", FILTER_SANITIZE_STRING)) == false ||
            (filter_input(INPUT_POST, "CF", FILTER_SANITIZE_STRING)) == false ||
            (filter_input(INPUT_POST, "sesso", FILTER_SANITIZE_STRING)) == false ||
            (filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) == false ||
            (filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING)) == false) {
                print "0";
                die();
        }

        if (strlen($CF) != 16) {
            print "0";
            die();
        }

        $_SESSION["email"] = $email;
        $_SESSION["password"] = $password;

        $db = connection_db();
        $password = md5($password);
        $name = $db->quote($name);
        $surname = $db->quote($surname); 
        $CF = $db->quote($CF);
        $sesso = $db->quote($sesso);
        $date = $db->quote($date); 
        $password = $db->quote($password);
        $email = $db->quote($email); 
        $admin = $db->quote($admin);

        // Richiamo la query
        $searchEmail = verifyAdmin($email, $db);

        // Gestisco il valore di ritorno della query
        if (($searchEmail->rowCount()) == 1) {
            print "-3";
            die();
        }

        // Richiamo la query
        $searchCF = searchCF($CF, $db);

        // Gestisco il valore di ritorno della query
        if (($searchCF->rowCount()) != 0) {
            print "-1";
            die();
        } else {
            // Richiamo la query
            $rows = insertUser($name, $surname, $CF, $sesso, $date, $email, $password, $admin, $db);
            // Gestisco il valore di ritorno della query
            if (($rows->rowCount()) == 0) {
                print "-2";
                die();
            } else if (($rows->rowCount()) != 0) {
                print "1";
            }
        }
    }
?>