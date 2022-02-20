<?php include('connessione_database.php') ?>
<?php include('loggato.php') ?>
<?php
	if ($_SESSION['username'] != 'admin') {
		header('location: index.php');
		exit;
	}
?>

<?php
	//Si selezionano le tuple corrispondenti alla data e agli esami selezionati
	$res = array();
	$query = $mysqli->prepare("SELECT V.id, V.codFiscale, E.esame, V.data, V.ora FROM visite V INNER JOIN esami E ON V.esame = E.id WHERE E.esame = ? AND V.data = ?");
	foreach($_GET['esami'] as $val) {
		$query->bind_param('ss', $val, $_GET['data']);
		$query->execute();
		$result = $query->get_result();
		while($row = $result->fetch_assoc()){
			//Conversione formato data
			$row['data'] = date_format(date_create($row['data']), "d/m/Y");
			array_push($res, $row);
		}
	}
	print (json_encode($res));
?>