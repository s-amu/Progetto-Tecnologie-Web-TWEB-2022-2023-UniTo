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
    <!-- Pagina del sito dove un utente può scrivere recensioni su una corsa effettuata in precedenza -->
    <title>Scrivi una recensione - Cars On Track</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../../img/icons/iconHomepage.png" type="image/png" rel="shortcut icon">
	<link href="../../css/homepageStyle.css" type="text/css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../../js/review.js"></script>
  </head>
  <body>
    <?php
        include_once("../../html/header.html");
    ?>
    <h1>Valutaci e lascia la tua recensione</h1>

    <div id="recensione">
        <p><label>Seleziona il marchio di auto con cui hai corso:</label>
        <select name="marchioAuto"></select></p>
        <p><label>Seleziona il modello di auto con cui hai corso:</label>
        <select name="modelloAuto"></select></p>
        <p><label>Seleziona il circuito in cui hai corso:</label>
        <select name="circuito"></select></p>
        <p><label>Indica il tuo gradimento:</label>
        <label><input type="radio" name="grad" value="3" checked="checked">Ottimo</label>
        <label><input type="radio" name="grad" value="2">Normale</label>
        <label><input type="radio" name="grad" value="1">Pessimo</label></p>
        <p><label>Indica il giorno in cui hai corso:</label>
        <input type="date" name="data"></p>
        <p><label>Indica l'orario in cui hai corso:</label>
        <select name="ora">
            <option>09:00</option>
            <option>10:00</option>
            <option>11:00</option>
            <option>12:30</option>
            <option>13:30</option>
            <option>14:30</option>
            <option>15:30</option>
        </select></p>
        <p><label>Scrivi la tua recensione:</label></p>
        <p><textarea rows="6" cols="99" required></textarea></p>
        <p class="error"></p>
        <p><input class="btn" type="submit" value="Invia Recensione"></p>
    </div>
    <?php
        include_once("../../html/footer.html");
    ?>
<?php
	} else {
		// Altrimenti si rimanda alla pagina di accesso
		header("location: ../../index.php");
	}
?>