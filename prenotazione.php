<?php include('inserimento_prenotazione.php') ?>
<?php include('variabili_globali.php') ?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<title>Prenotazione</title>
		<link rel="stylesheet" type="text/css" href="css/prenotazione.css">
		<link rel="stylesheet" type="text/css" href="css/buttons.css">
		<link rel="stylesheet" type="text/css" href="css/errori.css">
		<link rel="stylesheet" type="text/css" href="css/datepicker.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="js/datepickerIta.js"></script>
  		<script src="js/calendarioPrenotazioni.js"></script>
  		<script src="js/orari.js"></script>
  		<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  		<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
	</head>
	<body>
		<?php include ('header2.php') ?>
		<h3>Prenotazione</h3>	
		<div id="container">
			<p><strong>Attenzione!</strong> Si ricorda che è possibile disdire un esame fino a 2 giorni prima della data di prenotazione</p>
			<form action="prenotazione.php" method="post">
				<?php
					if($_SESSION['username'] == 'admin'){
						print '<div id="altri">';
						print '<p>Inserisci il codice fiscale della persona per cui si sta effettuando la prenotazione</p>';
						print '<input type="text" name="codFiscaleAltri" id="codFiscaleAltri" required>';
						print '</div>';
					}
				?>
				<div id="esame">
					<p>Selezionare la tipologia di esame</p>
					<?php
						//Generazione pulsante esami
						$oggi = date("Y-m-d");
						$query = "SELECT * FROM esami ORDER BY esame";
						$query_result = $mysqli->query($query);
						while($row = mysqli_fetch_assoc($query_result)) {
							//Variabili contenenti il numero massimo di visite giornaliere di un esame
							$max_visite_esame = (floor(60 * ($FINE_MATTINA - $INIZIO_MATTINA) / $row['durata']) + floor(60 * ($FINE_POMERIGGIO - $INIZIO_POMERIGGIO) / $row['durata']));
							$max_visite_esame_sab = (floor(60 * ($FINE_MATTINA - $INIZIO_MATTINA) / $row['durata']));

							//Si inseriscono le date non più disponibili di un esame in un array
							$dateNonValide[$row['esame']] = array();
							$query2 = "SELECT data FROM visite WHERE esame = '{$row['id']}' AND giorno <> 6 AND data > '{$oggi}' GROUP BY esame, data HAVING COUNT(data) = '{$max_visite_esame}' UNION
								SELECT data FROM visite WHERE esame = '{$row['id']}' AND giorno = 6 AND data > '{$oggi}' GROUP BY esame, data HAVING COUNT(data) = '{$max_visite_esame_sab}'";
							$query_result2 = $mysqli->query($query2);
							while($row2 = mysqli_fetch_assoc($query_result2)) {
								array_push($dateNonValide[$row['esame']], $row2['data']);
							}

							//Si inseriscono nell'array creato in precedenza anche le date bloccate dall'admin
							$query3 = "SELECT data FROM datebloccate WHERE id_esame = '{$row['id']}'";
							$query_result3 = $mysqli->query($query3);
							while($row3 = mysqli_fetch_assoc($query_result3)) {
								if(!in_array($row3['data'], $dateNonValide[$row['esame']])) {
									array_push($dateNonValide[$row['esame']], $row3['data']);
								}
							}

							//Si controlla se il numero di date non valide coincide con il numero di giorni prenotabili di un esame
							//Si controlla così se tutte le date di un esame sono interamente prenotate o bloccate dall'admin
							if (count($dateNonValide[$row['esame']]) == ($GIORNI_PRENOTABILI - floor($GIORNI_PRENOTABILI / 7)
								+ ((((date('w') - 1) % 7) > ((6 - $GIORNI_PRENOTABILI) % 7)) ? 1 : 0))) {
									//Se non ci sono date prenotabili si annerisce il pulsante dell'esame
									print '<input type="radio" name="esame" id="'.$row['esame'].'" value="'.$row['esame'].'" disabled>';
									print '<label for="'.$row['esame'].'" class="disabled" disabled>'.$row['esame'].'</label>';
							}
							else {
								print '<input type="radio" name="esame" id="'.$row['esame'].'" value="'.$row['esame'].'">';
								print '<label for="'.$row['esame'].'">'.$row['esame'].'</label>';
							}
						}
						//Si inseriscono le date non valide in un file
						file_put_contents('dateNonValide.json', json_encode($dateNonValide));
					?>
				</div>
				<div id="data"></div>
		   	    <div id="orari"></div>
	      	</form>
	      	<?php include ('errori.php') ?>
      	</div>		
 		<?php include ('footer.php') ?>
 	</body>
 </html>