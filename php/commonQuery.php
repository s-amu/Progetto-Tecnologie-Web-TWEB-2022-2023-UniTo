<?php
    /* File comune con tutte le query per interrogare il database */
    
    // Funzione per connettersi al database tweb
    function connection_db() {
        try {
            $db = new PDO("mysql:dbname=tweb;host=localhost:3306", "root", "");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            die("Could not connect: " . $ex->getMessage());
        }

        return $db;
    }

    // Funzione con query che ritorna nome e cognome di un utente
    function searchUser($email, $password, $db) {
        try {
        $rows = $db->query("SELECT `Nome`, `Cognome`
                            FROM `users`
                            WHERE `Email` = $email AND `Password` = $password");
        } catch (PDOException $ex) {
            header("refresh:5;url=../index.php");
            echo "ATTENZIONE! C'è stato un errore.";
            die("Query (Search) failed: " . $ex->getMessage());
        }

        return $rows;
    }

    // Funzione con query che inserisce un utente
    function insertUser($name, $surname, $CF, $sesso, $date, $email, $password, $admin, $db) {
        try {
        $rows = $db->query("INSERT INTO `users` (`Nome`, `Cognome`, `CF`, `Sesso`, `DataNascita`, `Email`, `Password`, `Admin`)
                            VALUES ($name, $surname, $CF, $sesso, $date, $email, $password, $admin)");
        } catch (PDOException $ex) {
            header("refresh:5;url=registration/pageRegistration.php");
            echo "ATTENZIONE! C'è stato un errore.";
            die("Query (Insert) failed: " . $ex->getMessage());
        }

        return $rows;
    }

    // Funzione con query che ritorna tutti i dati di un utente
    function searchCF($CF, $db) {
        try {
        $rows = $db->query("SELECT *
                            FROM `users`
                            WHERE `CF` LIKE $CF");
        } catch (PDOException $ex) {
            header("refresh:5;url=registration/pageRegistration.php");
            echo "ATTENZIONE! C'è stato un errore.";
            die("Query (Search) failed: " . $ex->getMessage());
        }

        return $rows;
    }

    // Funzione con query che ritorna tutti i dati di una certa tabella
    function viewTable($table, $db) {
        try {
        $rows = $db->query("SELECT *
                            FROM `$table`
                            ORDER BY `ID` ASC");
        } catch (PDOException $ex) {
            header("refresh:5;url=homepage.php");
            echo "ATTENZIONE! C'è stato un errore.";
            die("Query (View) failed: " . $ex->getMessage());
        }

        return $rows;
    }

    // Funzione con query che ritorna tutte le recensioni
    function viewTableReviews($db) {
        try {
        $rows = $db->query("SELECT DISTINCT `users`.`Nome`, `Cognome`, `tracks`.`Nome` AS `NomePista`, `Marchio`, `Modello`, `Grado`, `Commento`
                            FROM `cars` JOIN `reviews` ON (NumeroTelaio=Auto) JOIN `users` ON (CF=Autore) JOIN `tracks` ON (tracks.ID=Circuito)
                            ORDER BY `reviews`.`ID` DESC");
        } catch (PDOException $ex) {
            header("refresh:5;url=homepage.php");
            echo "ATTENZIONE! C'è stato un errore.";
            die("Query (View) failed: " . $ex->getMessage());
        }

        return $rows;
    }

    // Funzione con query che ritorna il numero di telaio di un'auto
    function returnNumTelaio($marchio, $modello, $db) {
        try {
        $rows = $db->query("SELECT `NumeroTelaio`
                            FROM `cars`
                            WHERE `Marchio` LIKE $marchio AND `Modello` LIKE $modello");
        } catch (PDOException $ex) {
            header("refresh:5;url=../index.php");
            echo "ATTENZIONE! C'è stato un errore.";
            die("Query (Search) failed: " . $ex->getMessage());
        }

        return $rows;
    }

    // Funzione con query che ritorna l'ID di una pista
    function returnIDtrack($nome, $db) {
        try {
        $rows = $db->query("SELECT `ID`
                            FROM `tracks`
                            WHERE `Nome` LIKE $nome");
        } catch (PDOException $ex) {
            header("refresh:5;url=../index.php");
            echo "ATTENZIONE! C'è stato un errore.";
            die("Query (Search) failed: " . $ex->getMessage());
        }

        return $rows;
    }

    // Funzione con query che ritorna il CF di un utente
    function returnCF($email, $db) {
        try {
        $rows = $db->query("SELECT `CF`
                            FROM `users`
                            WHERE `Email` LIKE $email");
        } catch (PDOException $ex) {
            header("refresh:5;url=registration/pageRegistration.php");
            echo "ATTENZIONE! C'è stato un errore.";
            die("Query (Search) failed: " . $ex->getMessage());
        }

        return $rows;
    }

    // Funzione con query che ritorna tutti i dati di un certo utente
    function verifyAdmin($email, $db) {
        try {
        $rows = $db->query("SELECT *
                            FROM `users`
                            WHERE `Email` LIKE $email");
        } catch (PDOException $ex) {
            header("refresh:5;url=../index.php");
            echo "ATTENZIONE! C'è stato un errore.";
            die("Query (Search) failed: " . $ex->getMessage());
        }

        return $rows;
    }

    // Funzione con query che inserisce un'auto
    function insertCar($telaio, $marchio, $modello, $anno, $cavalli, $prezzo, $descrizione, $db) {
        try {
        $rows = $db->query("INSERT INTO `cars` (`NumeroTelaio`, `Marchio`, `Modello`, `Anno`, `Cavalli`, `Prezzo`, `Descrizione`)
                            VALUES ($telaio, $marchio, $modello, $anno, $cavalli, $prezzo, $descrizione)");
        } catch (PDOException $ex) {
            header("refresh:5;url=registration/pageRegistration.php");
            echo "ATTENZIONE! C'è stato un errore.";
            die("Query (Insert) failed: " . $ex->getMessage());
        }

        return $rows;
    }

    // Funzione con query che inserisce una pista
    function insertTrack($nome, $citta, $lunghezza, $numeroCurve, $db) {
        try {
        $rows = $db->query("INSERT INTO `tracks` (`Nome`, `Città`, `Lunghezza`, `NumeroCurve`)
                            VALUES ($nome, $citta, $lunghezza, $numeroCurve)");
        } catch (PDOException $ex) {
            header("refresh:5;url=registration/pageRegistration.php");
            echo "ATTENZIONE! C'è stato un errore.";
            die("Query (Insert) failed: " . $ex->getMessage());
        }

        return $rows;
    }

    // Funzione con query che rimuove un'auto
    function removeCar($telaio, $db) {
        try {
        $rows = $db->query("DELETE FROM `cars`
                            WHERE `NumeroTelaio` LIKE $telaio");
        } catch (PDOException $ex) {
            header("refresh:5;url=registration/pageRegistration.php");
            echo "ATTENZIONE! C'è stato un errore.";
            die("Query (Insert) failed: " . $ex->getMessage());
        }

        return $rows;
    }

    // Funzione con query che rimuove una pista
    function removeTrack($id, $db) {
        try {
        $rows = $db->query("DELETE FROM `tracks`
                            WHERE `ID` LIKE $id");
        } catch (PDOException $ex) {
            header("refresh:5;url=registration/pageRegistration.php");
            echo "ATTENZIONE! C'è stato un errore.";
            die("Query (Insert) failed: " . $ex->getMessage());
        }

        return $rows;
    }

    // Funzione con query che inserisce una prenotazione
    function insertReservation($marchio, $modello, $pista, $data, $ora, $email, $db) {
        $utente = returnCF($email, $db);
        $view = array();
        $res = $utente->fetchAll();
        foreach ($res as $row) {
            $view[] = $row;
        }
        $utente = $db->quote($view[0][0]);
        
        $auto = returnNumTelaio($marchio, $modello, $db);
        $view = array();
        $res = $auto->fetchAll();
        foreach ($res as $row) {
            $view[] = $row;
        }
        $auto = $db->quote($view[0][0]);

        $pista = returnIDtrack($pista, $db);
        $view = array();
        $res = $pista->fetchAll();
        foreach ($res as $row) {
            $view[] = $row;
        }
        $pista = $db->quote($view[0][0]);

        try {
        $rows = $db->query("INSERT INTO `reservations` (`Auto`, `Pista`, `Utente`, `Data`, `Ora`)
                            VALUES ($auto, $pista, $utente, $data, $ora)");
        } catch (PDOException $ex) {
            header("refresh:5;url=registration/pageRegistration.php");
            echo "ATTENZIONE! C'è stato un errore.";
            die("Query (Insert) failed: " . $ex->getMessage());
        }

        return $rows;
    }

    // Funzione con query che cerca una certa prenotazione
    function searchReservation($marchio, $modello, $pista, $data, $ora, $email, $db) {
        $utente = returnCF($email, $db);
        $view = array();
        $res = $utente->fetchAll();
        foreach ($res as $row) {
            $view[] = $row;
        }
        $utente = $db->quote($view[0][0]);
        
        $auto = returnNumTelaio($marchio, $modello, $db);
        $view = array();
        $res = $auto->fetchAll();
        foreach ($res as $row) {
            $view[] = $row;
        }
        $auto = $db->quote($view[0][0]);

        $pista = returnIDtrack($pista, $db);
        $view = array();
        $res = $pista->fetchAll();
        foreach ($res as $row) {
            $view[] = $row;
        }
        $pista = $db->quote($view[0][0]);

        try {
        $rows = $db->query("SELECT *
                            FROM `reservations`
                            WHERE `Auto` LIKE $auto AND `Pista` LIKE $pista AND `Utente` LIKE $utente
                            AND `Data` LIKE $data AND `Ora` LIKE $ora");
        } catch (PDOException $ex) {
            header("refresh:5;url=registration/pageRegistration.php");
            echo "ATTENZIONE! C'è stato un errore.";
            die("Query (Insert) failed: " . $ex->getMessage());
        }

        return $rows;
    }

    // Funzione con query che inserisce una recensione
    function insertReview($email, $marchio, $modello, $pista, $review, $degreePreference, $db) {
        $utente = returnCF($email, $db);
        $view = array();
        $res = $utente->fetchAll();
        foreach ($res as $row) {
            $view[] = $row;
        }
        $utente = $db->quote($view[0][0]);
        
        $auto = returnNumTelaio($marchio, $modello, $db);
        $view = array();
        $res = $auto->fetchAll();
        foreach ($res as $row) {
            $view[] = $row;
        }
        $auto = $db->quote($view[0][0]);

        $pista = returnIDtrack($pista, $db);
        $view = array();
        $res = $pista->fetchAll();
        foreach ($res as $row) {
            $view[] = $row;
        }
        $pista = $db->quote($view[0][0]);

        try {
            $rows = $db->query("INSERT INTO `reviews` (`Autore`, `Auto`, `Circuito`, `Commento`, `Grado`) 
                                VALUES ($utente, $auto, $pista, $review, $degreePreference)");
            } catch (PDOException $ex) {
                header("refresh:5;url=registration/pageRegistration.php");
                echo "ATTENZIONE! C'è stato un errore.";
                die("Query (Insert) failed: " . $ex->getMessage());
            }
        return $rows;
    }
?>