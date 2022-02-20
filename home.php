<?php include('connessione_database.php') ?>
<?php include('loggato.php') ?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<title>Home personale</title>
		<link rel="stylesheet" type="text/css" href="css/home.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
	</head>
	<body>
		<?php include ('header2.php') ?>
		<h3>Ti diamo il benvenuto <?php print ($_SESSION['username']); ?></h3>
		<div id="container">
			<div class="button">
				<img src="img/pencil.svg" alt="Matita">
				<a href="prenotazione.php"><p>Prenota</p></a>
			</div>
			<div class="button">
				<img src="img/calendar3.svg" alt="Calendario">
				<a href="appuntamenti.php"><p>Appuntamenti</p></a>
			</div>
			<div class="button">
				<?php
					if($_SESSION['username'] == "admin") {
						print '<img src="img/gear-fill.svg" alt="Ingranaggio">';
						print '<a href="gestione_esami.php"><p>Gestione Esami</p></a>';
					}
					else {
						print '<img src="img/clipboard.svg" alt="Lista">';
						print '<a href="referti.php"><p>Referti</p></a>';
					}
				?>
			</div>
			<?php
				if($_SESSION['username'] == "admin") {
					print '<div class="button">';
					print '<img src="img/bar-chart-line-fill.svg" alt="Grafico a barre">';
					print '<a href="feedback_admin.php"><p>Feedback</p></a>';
					print '</div>';
				}
			?>
			<div class="button">
				<img src="img/person-fill.svg" alt="Profilo">
				<a href="modifica_profilo.php"><p>Modifica profilo</p></a>
			</div>
			<div class="button">
				<img src="img/box-arrow-in-left.svg" alt="Uscita">
				<a href="logout.php"><p>Logout</p></a>
			</div>
		</div>
		<?php include ('footer.php') ?>
 	</body>
 </html>
