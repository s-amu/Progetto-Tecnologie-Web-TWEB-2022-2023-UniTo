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
    <!-- Homepage del sito Cars On Track dalla quale si possono visionare tutte le auto, le piste e le recensioni -->
    <title>Home Page - Cars On Track</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../img/icons/iconHomepage.png" type="image/png" rel="shortcut icon">
	<link href="../css/homepageStyle.css" type="text/css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/homepage.js"></script>
  </head>
  <body>
    <?php
        include_once("../html/header.html");
    ?>
    <h1>Benvenuto su Cars On Track</h1>
    <div class="logoutMex"></div>
    <div id="treImg">
        <div class="divImgAuto">
            <h3>Scopri tutte le nostre auto CLICCANDO l'immagine qua sotto!</h3>
                <img src="../img/cars/cars.jpg" alt="galleria auto" title="Vai alla galleria auto" class="imgLink">
        </div>
        <div class="divImgCircuiti">
            <h3>Scopri tutti i nostri circuiti CLICCANDO l'immagine qua sotto!</h3>
                <img src="../img/tracks/tracks.jpeg" alt="galleria circuiti" title="Vai alla galleria circuiti" class="imgLink">
        </div>
        <div class="divImgRecensioni">
            <h3>Scopri tutte le recensioni CLICCANDO l'immagine qua sotto!</h3>
                <img src="../img/reviews/reviews.jpg" alt="recensioni" title="Vai alle recensioni" class="imgLink">
        </div>
    </div>
    <div class="elenco">
        <table id="list"></table>
    </div>
<?php
    include_once("../html/footer.html");
?>
<?php
	} else {
		// Altrimenti si rimanda alla pagina di accesso
		header("location: ../index.php");
	}
?>