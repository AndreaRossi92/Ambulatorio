<?php include ('connessione_database.php') ?>
<?php include('loggato.php') ?>
<?php include('variabili_globali.php') ?>

<?php
	// Controllo degli orari non disponibili
	if(isset($_GET['esame'], $_GET['data'])){
		$esame = $_GET['esame'];
		$data = $_GET['data'];
		$query = $mysqli->prepare("SELECT ora FROM visite V INNER JOIN esami E ON V.esame = E.id WHERE E.esame = ? AND V.data = ?");
		$query->bind_param('ss', $esame, $data);
		$query->execute();
		$result = $query->get_result();
		$oreNonValide =array();
		while($row = $result->fetch_assoc()){
			$oreNonValide[] = $row['ora'];
		}
		//Si seleziona la durata dell'esame
		$query = $mysqli->prepare("SELECT durata FROM esami WHERE esame = ?");
		$query->bind_param('s', $esame);
		$query->execute();
		$result = $query->get_result();
		$row = $result->fetch_assoc();
		$durata = $row['durata'];
		$res = array();
		//Inserimento in un array dei dati relativi all'esame selezionato con annessi gli orari non disponibili
		$res = array("durata" => intval($durata), "INIZIO_MATTINA" => $INIZIO_MATTINA,"FINE_MATTINA" => $FINE_MATTINA, 
			"INIZIO_POMERIGGIO" => $INIZIO_POMERIGGIO, "FINE_POMERIGGIO" => $FINE_POMERIGGIO, "oreNonValide" => $oreNonValide);
		print json_encode($res);
	}
	else {
		array_push($errori, "Errore");
	}
?>