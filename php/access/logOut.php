<?php
	/* Script php che permette la disconnessione dal sito */
	
	// Se non è presente una sessione la creo
	if(!isset($_SESSION)) {
		session_start();
	}
	// Se è presente una sessione la cancello
    if(isset($_SESSION)) {
    	session_regenerate_id(TRUE); // Così gli ID dei prossimi session_start() saranno sempre diversi
      	session_unset(); // Dealloco tutte le variabili
	  	session_destroy(); // Cancello la sessione
		header("location: ../../index.php?logout");
	} else {
		header("location: ../../index.php?logout");
	}
?>