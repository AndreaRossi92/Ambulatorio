<?php include('connessione_database.php') ?>
<?php include('loggato.php') ?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<title>Referti</title>
		<link rel="stylesheet" type="text/css" href="css/tabella.css">
		<link rel="stylesheet" type="text/css" href="css/buttons.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="js/disdici.js"></script>
	</head>
	<body>
		<?php include ('header2.php') ?>
		<h3>Referti</h3>
		<div id="container">
			<table class="tabella">
				<thead>
					<tr>
						<th>Esame</th>
						<th>Data</th>
						<th>Ora</th>
					</tr>
				</thead>
				<tbody>
					<?php
						/*Si cercano i file nella cartella dei referti relativi all'utente e si genera una tabella contente
						il link ai referti ed i dati del relativo esame*/
						//'@': Se la cartella non esiste non vengono visualizzati warning
						if ($percorso = @opendir('referti/'.$_SESSION['codFiscale'])) {
						    while (false !== ($entry = readdir($percorso))) {
						    	if ($entry != "." && $entry != "..") {
							        $array = explode("-", $entry);
							        print "<tr>";
									print "<td><a href='referti/".$_SESSION['codFiscale']."/".$entry."' download='referto'>".$array[5]."</a></td>";
									print "<td>".$array[2]."/".$array[1]."/".$array[0]."</td>";
									print "<td>".$array[3].":".$array[4]."</td>";
									print "</tr>";
								}
						    }
						    closedir($percorso);
						}
					?>
				</tbody>
			</table>
			<?php include ('errori.php') ?>
		</div>
 		<?php include ('footer.php') ?>
 	</body>
 </html>