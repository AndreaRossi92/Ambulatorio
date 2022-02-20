<?php include('connessione_database.php') ?>
<?php include('loggato.php') ?>
<?php
	if ($_SESSION['username'] != 'admin') {
		header('location: index.php');
		exit;
	}
?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<title>Feedback</title>
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="css/datepicker.css">
		<link rel="stylesheet" type="text/css" href="css/grafico.css">
		<link rel="stylesheet" type="text/css" href="css/buttons.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="js/datepickerIta.js"></script>
		<script src="js/calendarioFeedback.js"></script>
		<script src="js/grafici.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  		<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
	</head>
	<body>
		<?php include ('header2.php') ?>
		<h3>Feedback</h3>
		<div id="container">
			<div id="selezione">
				<div id="esami">
					<p>Selezionare una o più tipologie di esame</p>
					<?php
						//Si generano i pulsanti degli esami
						$query = "SELECT * FROM esami ORDER BY esame";
						$query_result = $mysqli->query($query);
						while($row = mysqli_fetch_assoc($query_result)) {
							print '<input type="checkbox" name="esame" id="'.$row['id'].'" value="'.$row['esame'].'">';
							print '<label for="'.$row['id'].'">'.$row['esame'].'</label>';
						}
					?>
				</div>
				<div id="date">
					<p>Selezionare un intervallo di date</p>
					<label for="dataIniziale">Inizio</label>
					<input type="text" id="dataIniziale">
					<br>
					<label for="dataFinale">Fine</label>
					<input type="text" id="dataFinale">
				</div>
			</div>
			<div id="dati"></div>
		</div>
		<?php include ('footer.php') ?>
	</body>
</html>