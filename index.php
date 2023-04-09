<?php
    // Se non è presente una sessione la creo
	if(!isset($_SESSION)) {
        session_start();
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Pagina iniziale del sito dove l'utente può effettuare il LogIn ed accedere all'homepage se possiede già un account -->
    <title>Accedi - Cars On Track</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="img/icons/iconLogIn.png" type="image/png" rel="shortcut icon">
	<link href="css/indexStyle.css" type="text/css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/index.js"></script>
</head>
  <body>
    <div class="logoutMex"></div>
    <div id="logIn">
        <div id="logInDx">
            <div>
                <h2>Accedi</h2>
                <p><label>Email:</label>
                <input name="email" type="email" size="25" placeholder="Es: nome@email.com" autofocus="autofocus" 
                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                       title="L'email dev'essere nell'ordine 'caratteri@caratteri.dominio' e dopo il '.' devono esserci almeno due caratteri" 
                       required></p>
                <p><label>Password:</label>
                <input name="password" type="password" size="15" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                       title="Deve contenere almeno un numero, una lettera maiuscola, una minuscola e almeno 8 caratteri" 
                       required>
                <input type="button" class="btnMostraNascondi" value="Mostra password"></p>
                <p class="error"></p>
                <p><input class="btn" type="submit" value="Accedi"></p>
                <p class="redirect">Non hai un account? <a href="php/registration/pageRegistration.php">Registrati</a></p>
            </div>		
        </div>
        <div id="logInSx">
            <p></p>
        </div>
    </div>
<?php
    include_once("html/footer.html");
?>