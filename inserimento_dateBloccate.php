<?php include('connessione_database.php') ?>
<?php include('loggato.php') ?>
<?php
	if ($_SESSION['username'] != 'admin') {
		header('location: index.php');
		exit;
	}
?>

<?php
	if(isset($_GET['esame'])) {
		//Si eliminano le date bloccate dell'esame selezionato
		$query = $mysqli->prepare("DELETE FROM datebloccate WHERE id_esame = ?");
		$query->bind_param('i', $_GET['esame']);
		$query->execute();
		//Se ci sono date da bloccare si inseriscono nel database
		if($_GET['date'] != "") {
			$array = explode(",", $_GET['date']);
			foreach ($array as $value) {
				$query = $mysqli->prepare("INSERT INTO datebloccate VALUES (?, ?)");
				$query->bind_param('ss', $_GET['esame'], $value);
				$query->execute();
			}
		}
		//Stampa alert
		echo "<script>alert('Modifica effettuata correttamente'); window.location.href='gestione_esami.php';</script>";
	}
?>