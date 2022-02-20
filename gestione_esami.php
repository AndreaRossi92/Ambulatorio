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
		<title>Gestione esami</title>
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="css/datepicker.css">
		<link rel="stylesheet" type="text/css" href="css/gestione_esami.css">
		<link rel="stylesheet" type="text/css" href="css/buttons.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="js/datepickerIta.js"></script>
		<script src="js/calendarioGestione.js"></script>
		<script src="js/dateBloccate.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  		<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
	</head>
	<body>
		<?php include ('header2.php') ?>
		<h3>Gestione esami</h3>
		<div id="container">
			<div id="esami">
				<p>Selezionare la tipologia di esame</p>
				<?php
					//Generazione dei pulsanti degli esami
					$query = "SELECT * FROM esami ORDER BY esame";
					$query_result = $mysqli->query($query);
					while($row = mysqli_fetch_assoc($query_result)) {
						print '<input type="radio" name="esame" id="'.$row['id'].'" value="'.$row['esame'].'">';
						print '<label for="'.$row['id'].'">'.$row['esame'].'</label>';
					}
				?>
			</div>
			<div id="date"></div>
			<div id="button"></div>
		</div>
		<?php include ('footer.php') ?>
	</body>	
</html>