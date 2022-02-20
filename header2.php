<?php
	//Stampa dell'header dopo il login
	print'
	<header>	
		<img src="img/Stemma_unipi.png" alt="Stemma Unipi">
		<h1><a href="logout.php">Ambulatorio Unipi</a></h1>
		<a href="home.php">HOME</a>
		<a href="prenotazione.php">Prenota</a>
		<a href="appuntamenti.php">Appuntamenti</a>';
		if($_SESSION['username'] == 'admin') {
			print ('<a href="gestione_esami.php">Gestione esami</a>');
			print ('<a href="feedback_admin.php">Feedback</a>');
		}
		else {
			print ('<a href="referti.php">Referti</a>');
		}
		print '
		<a href="modifica_profilo.php">Modifica profilo</a>
		<a href="logout.php">Logout</a>
	</header>';
?>