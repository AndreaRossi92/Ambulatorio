<?php include('connessione_database.php') ?>
<?php include('loggato.php') ?>

<?php
if(isset($_POST['conferma'])) {
	//Controllo validità orario ed eventuale codice fiscale inserito dall'admin
	if(empty($_POST['orario'])) {array_push($errori, "Selezionare un orario");}
	if(isset($_POST['codFiscaleAltri'])){
		if(!preg_match("/^[A-Z]{6}\d{2}[A-Z]\d{2}[A-Z]\d{3}[A-Z]$/i", $_POST['codFiscaleAltri'])) {array_push($errori, "Codice fiscale non valido");}
	}
	//Se non ci sono errori
	if(count($errori) == 0) {
		//Variabili contenenti i dati inseriti nel form
		$arrayData = explode("/", $_POST['datepicker']);
		$codFiscale = (isset($_POST['codFiscaleAltri'])) ? strtoupper($_POST['codFiscaleAltri']) : $_SESSION['codFiscale'];
      	$data = $arrayData[2]."-".$arrayData[1]."-".$arrayData[0];
      	$giornoSettimana = (int)$_POST['giornoSettimana'];

      	//Selezione id esame
      	if($query = $mysqli->prepare('SELECT id FROM esami WHERE esame = ?')) {	
			$query->bind_param('s', $_POST['esame']);
			$query->execute();
			$query->bind_result($id_esame);
			$query->fetch();
			$query->close();
		}
		else {
			echo "<script>alert('Errore operazione database');</script>";
		}
		//Inserimento della prenotazione nel database
		if($query = $mysqli->prepare('INSERT INTO visite (codFiscale, esame, data, ora, giorno) VALUES (?, ?, ?, ?, ?)')) {
			$query->bind_param('sissi', $codFiscale, $id_esame, $data, $_POST['orario'], $giornoSettimana);
			$query->execute();
			if($_SESSION['username'] != 'admin') {
				//Stampa alert utente
				echo "<script>alert('Appuntamento prenotato. Verrai reindirizzato alla pagina dei tuoi appuntamenti');
					window.location.href='appuntamenti.php';</script>";
			}
			else {
				//Stampa alert admin
				echo "<script>alert('Appuntamento prenotato'); window.location.href='prenotazione.php';</script>";

			}
		}
		else {
			echo "<script>alert('Errore inserimento nel database');</script>";
		}
	}
}
?>