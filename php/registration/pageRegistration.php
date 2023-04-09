<?php
    // Se non è presente una sessione la creo
	if(!isset($_SESSION)) {
        session_start();
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Pagina di registrazione del sito dove un utente può creare un nuovo account -->
    <title>Registrati - Cars On Track</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../../img/icons/iconRegistration.png" type="image/jpg" rel="shortcut icon">
	<link href="../../css/registrationStyle.css" type="text/css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../../js/registration.js"></script>
  </head>
  <body>
    <div id="reg">
        <div id="regDx">
            <div>
                <h2>Registrati</h2>
                <p><label>Nome*</label>
                <input type="text" placeholder="Nome" name="name" autofocus="autofocus" pattern="[a-zA-Z]{1,}" required></p>
                <p><label>Cognome*</label>
                <input type="text" placeholder="Cognome" name="surname" pattern="[a-zA-Z]{1,}" required></p>
                <p><label>Codice Fiscale*</label>
                <input type="text" placeholder="Codice Fiscale" name="CF" pattern="[a-zA-Z0-9]{16}" 
                       title="Deve contenere esattamente 16 caratteri" required></p>
                <p><label>Sesso</label>
                <label class="nb"><input type="radio" name="sesso" value="M"> Maschio</label>
                <label class="nb"><input type="radio" name="sesso" value="F"> Femmina</label></p>
                <p><label>Data di Nascita*</label>
                <input type="date" name="date" required></p>
                <p><label>Email*</label>
                <input type="email" name="email" size="25" placeholder="Es: nome@email.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                       title="L'email dev'essere nell'ordine 'caratteri@caratteri.dominio' e dopo il '.' devono esserci almeno due caratteri" 
                       required></p>
                <p><label>Password*</label>
                <input type="password" name="password" size="15" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                       required>
                <input type="button" class="btnMostraNascondi" value="Mostra password"></p>
                <p id="hover">La password deve contenere almeno 8 caratteri di cui un numero, una lettera maiuscola e una minuscola.</p>
                <p>* Campi obbligatori</p>
                <p class="error"></p>
                <p><input type="reset" class="btn">
                <input type="submit" class="btn" value="Registrati"></p>
                <p class="redirect">Hai già un account? <a href="../../index.php">Accedi</a></p>
            </div>	
        </div>
        <div id="regSx">
            <p></p>
        </div>
    </div>
<?php
    include_once("../../html/footer.html");
?>