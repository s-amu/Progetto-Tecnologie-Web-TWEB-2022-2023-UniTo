<?php
    // Se non è presente una sessione la creo
	if(!isset($_SESSION)) {	
        session_start();
    }
    // Se email e password sono settate in $_SESSION mostro la pagina
    if(isset($_SESSION["email"],$_SESSION["password"])) {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Pagina del sito che permette a un utente di prenotare una corsa in pista -->
    <title>Prenota - Cars On Track</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../../img/icons/iconHomepage.png" type="image/png" rel="shortcut icon">
	<link href="../../css/homepageStyle.css" type="text/css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../../js/reservation.js"></script>
  </head>
  <body>
    <?php
        include_once("../../html/header.html");
    ?>
    <h1>Prenota la tua corsa</h1>

    <div id="prenotazione">
        <p><label>Scegli il marchio dell'auto:</label>
        <select name="marchioAuto" autofocus="autofocus"></select></p>
        <p><label>Scegli il modello dell'auto:</label>
        <select name="modelloAuto"></select></p>
        <p><label>Scegli la pista:</label>
        <select name="pista"></select></p>
        <p><label>Scegli il giorno:</label>
        <input type="date" name="data"></p>
        <p><label>Scegli l'orario:</label>
        <select name="ora">
            <option>09:00</option>
            <option>10:00</option>
            <option>11:00</option>
            <option>12:30</option>
            <option>13:30</option>
            <option>14:30</option>
            <option>15:30</option>
        </select></p>
        <span><label>Prima di prenotare premi il pulsante "Tenta la fortuna", potresti ricevere un regalo!</label></span>
        <p class="error"></p>
        <p id="btnPrenota"><input class="btn" type="submit" value="Prenota">
        <input class="btn" type="button" value="Tenta la fortuna"></p>
        <p id="fortuna"></p>
    </div>	
<?php
    include_once("../../html/footer.html");

	} else {
		// Altrimenti si rimanda alla pagina di accesso
		header("location: ../../index.php");
	}
?>