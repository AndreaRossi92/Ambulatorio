<?php include ('connessione_database.php') ?>
<?php include ('loggato.php') ?>

<?php
	//Si elimina l'esame disdetto dal database
	if(isset($_GET['id_visita'])){
		if($_SESSION['username'] == 'admin') {
			$query = $mysqli->prepare("DELETE FROM visite WHERE id = ?");
			$query->bind_param('i', $_GET['id_visita']);
			$query->execute();
		}
		else {
			$mysqli->prepare("DELETE FROM visite WHERE id = ? AND codFiscale = ?");
			$query->bind_param('is', $_GET['id_visita'], $_SESSION['codFiscale']);
			$query->execute();
		}
		
	}