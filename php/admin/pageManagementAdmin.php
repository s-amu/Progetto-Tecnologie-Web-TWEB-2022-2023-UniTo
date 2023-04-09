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
    <!-- Pagina di gestione del sito riservata all'amministratore, dove si possono aggiungere e rimuovere auto e piste -->
    <title>Gestisci il sito - Cars On Track</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../../img/icons/iconHomepage.png" type="image/png" rel="shortcut icon">
	<link href="../../css/homepageStyle.css" type="text/css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../../js/managementAdmin.js"></script>
  </head>
  <body>
    <?php
        include_once("../../html/header.html");
    ?>
        <h1>Pagina di gestione auto e piste</h1>
    
        <div id="gestione">
            <p id="a"><input type="button" class="btnDelAuto" value="Elimina auto">
            <input type="button" class="btnAddAuto" value="Aggiungi auto "></p>
            <p id="b"><input type="button" class="btnDelPiste" value="Elimina pista">
            <input type="button" class="btnAddPiste" value="Aggiungi pista"></p>
        </div>		
       
<?php
    include_once("../../html/footer.html");

	} else {
		// Altrimenti si rimanda alla pagina di accesso
		header("location: ../../index.php");
	}
?>