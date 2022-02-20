<?php include('connessione_database.php') ?>
<?php include('loggato.php') ?>
<?php
	if ($_SESSION['username'] != 'admin') {
		header('location: index.php');
		exit;
	}
?>

<?php
	//Si selezionano le date bloccate dell'esame selezionato
	$res_array = array();
	$query = $mysqli->prepare("SELECT data FROM datebloccate WHERE id_esame = ?");
	$query->bind_param('i', $_GET['esame']);
	$query->execute();
	$result = $query->get_result();
	while($row = $result->fetch_assoc()){
		array_push($res_array, $row['data']);
	}
	print json_encode($res_array);
?>