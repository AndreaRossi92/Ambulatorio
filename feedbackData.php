<?php include ('connessione_database.php') ?>
<?php include ('loggato.php') ?>
<?php
	if ($_SESSION['username'] != 'admin') {
		header('location: index.php');
		exit;
	}
?>

<?php
	if(isset($_GET['esami'], $_GET['dataIniziale'], $_GET['dataFinale'])) {
		$risultati = array();
		$esami = "";
		//Si genera una stringa contenente gli esami selezionati
		for($i = 0 ; $i < count($_GET['esami']) ; $i++) {
			$esami .= $_GET['esami'][$i];
			if ($i < (count($_GET['esami']) - 1)) {
				$esami .= ", ";
			}
		}
		//Si cambia il formato data
		$array = explode("/", $_GET['dataIniziale']);
		$dataIniziale = $array[2].'-'.$array[1].'-'.$array[0];
		$array = explode("/", $_GET['dataFinale']);
		$dataFinale = $array[2].'-'.$array[1].'-'.$array[0];
		//Si selezionano i feedback relativi agli esami e all'intervallo di date selezionati
		$query = $mysqli->prepare("SELECT V.esame, F.orario, F.luogo, F.procedura, F.personale FROM feedback F INNER JOIN visite V ON F.id_visita = V.id WHERE V.data >= ? AND V.data <= ? AND V.esame IN (" . $esami . ")");
		$query->bind_param('ss', $dataIniziale, $dataFinale);
		$query->execute();
		$result = $query->get_result();
		while($row = $result->fetch_assoc()){
			isset($risultati['orario'][$row['orario']]) ? $risultati['orario'][$row['orario']]++ : $risultati['orario'][$row['orario']] = 1;
			isset($risultati['luogo'][$row['luogo']]) ? $risultati['luogo'][$row['luogo']]++ : $risultati['luogo'][$row['luogo']] = 1;
			isset($risultati['procedura'][$row['procedura']]) ? $risultati['procedura'][$row['procedura']]++ : $risultati['procedura'][$row['procedura']] = 1;
			isset($risultati['personale'][$row['personale']]) ? $risultati['personale'][$row['personale']]++ : $risultati['personale'][$row['personale']] = 1;
		}
		print json_encode($risultati);
	}
?>