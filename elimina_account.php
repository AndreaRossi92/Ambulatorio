<?php include ('connessione_database.php') ?>
<?php include ('loggato.php') ?>

<?php
	//Si elimina l'esame disdetto dal database
	if(isset($_GET['id_utente']) && $_GET['id_utente'] == $_SESSION['id']){
		$id_utente = $_GET['id_utente'];
		$query = "DELETE FROM utenti WHERE id = '{$id_utente}'";
		if ($query_result = $mysqli->query($query)) {
		echo "<script>alert('Account eliminato correttamente');
			window.location.href='index.php';</script>";
		}
		else {
			echo "<script>alert('Errore durante l'eliminazione);</script>";
		}
	}
	else {
		echo "<script>alert('Utente non valido');</script>";
	}
?>