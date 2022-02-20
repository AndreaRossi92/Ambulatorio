<?php include('connessione_database.php') ?>
<?php include('loggato.php') ?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<title>Appuntamenti</title>
		<link rel="stylesheet" type="text/css" href="css/tabella.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="css/datepicker.css">
		<link rel="stylesheet" type="text/css" href="css/appuntamenti.css">
		<link rel="stylesheet" type="text/css" href="css/buttons.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="js/disdici.js"></script>
		<script src="js/feedback.js"></script>
		<script src="js/datepickerIta.js"></script>
		<script src="js/calendarioAppuntamenti.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  		<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
	</head>
	<body>
		<?php include ('header2.php') ?>
		<h3>I tuoi appuntamenti</h3>
		<div id="container">
			<?php
				//Generazione pulsanti esami admin
				if($_SESSION['username'] == 'admin') {
					print '<div id="data"><p>Selezionare la data</p>';
					print '<input type="text" id="datepicker" name="datepicker" readonly required></div>';
					print '<div id="esami"><p>Selezionare le tipologie di esami</p>';
					$query = "SELECT * FROM esami ORDER BY esame";
					$query_result = $mysqli->query($query);
					while($row = mysqli_fetch_assoc($query_result)) {
						print '<input type="checkbox" name="esame" id="'.$row['esame'].'" value="'.$row['esame'].'">';
						print '<label for="'.$row['esame'].'">'.$row['esame'].'</label>';
					}
					print '</div>';
				}
			?>
			<table class="tabella">
				<thead>
					<tr>
						<th>Codice Fiscale</th>
						<th>Esame</th>
						<th>Data</th>
						<th>Ora</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						//Generazione tabella con gli appuntamenti dell'utente
						if($_SESSION['username'] != 'admin') {
							$query = "SELECT V.id, V.codFiscale, E.esame, V.data, V.ora, V.feedback FROM visite V INNER JOIN esami E ON V.esame = E.id WHERE V.codFiscale = '{$_SESSION['codFiscale']}' ORDER BY data DESC, ora DESC";
							$query_result = $mysqli->query($query);
							while($row = mysqli_fetch_assoc($query_result)) {
								$dataItaliana = date_format(date_create($row['data']), "d/m/Y");
								print "<tr>";
								print "<td>".$row['codFiscale']."</td>";
								print "<td>".$row['esame']."</td>";
								print "<td>".$dataItaliana."</td>";
								print "<td>".$row['ora']."</td>";
								//Si può disdire un appuntamento entro almeno 2 giorni
								if(date_format(date_sub(date_create($row['data']), date_interval_create_from_date_string("2 days")), "Y-m-d") > date("Y-m-d")) {
									print "<td><input type='button' name='disdici' id='".$row['id']."' value='DISDICI'></td>";
								}
								//Si può inserire un feedback dal giorno dopo l'appuntamento in poi
								else if ($row['data'] < date("Y-m-d")) {
									if ($row['feedback'] == 0) {
										print "<td><input type='button' name='feedback' id='".$row['id']."' value='VALUTA'></td>";
									}
									else {
										print "<td><p>Valutato</p></td>";
									}
								}
								else {
									print "<td></td>";
								}
								print "</tr>";
							}
						}
					?>
				</tbody>
			</table>
 		</div>
 		<?php include ('footer.php') ?>
 	</body>
</html>