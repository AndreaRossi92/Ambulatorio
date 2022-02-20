<?php include('connessione_database.php') ?>
<?php include('loggato.php') ?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<title>Feedback</title>
		<link rel="stylesheet" type="text/css" href="css/feedback.css">
		<link rel="stylesheet" type="text/css" href="css/buttons.css">
		<link rel="stylesheet" type="text/css" href="css/errori.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	</head>
	<body>
		<?php include ('header2.php') ?>
		<?php
			//Si insersce il feedback nel database e si pone ad 1 il flag del feedback della relativa visita
			$id_visita = $_GET['id_visita'];
			if(isset($_POST['conferma'])) {
				if(isset($_POST['feedback1'], $_POST['feedback2'], $_POST['feedback3'], $_POST['feedback4'])) {
					$query = $mysqli->prepare('INSERT INTO feedback (id_visita, orario, luogo, procedura, personale) VALUES (?, ?, ?, ?, ?)');
					$query->bind_param('issss', $id_visita, $_POST['feedback1'], $_POST['feedback2'], $_POST['feedback3'], $_POST['feedback4']);
					$query->execute();
					$query = $mysqli->prepare("UPDATE visite SET feedback = 1 WHERE id = ?");
					$query->bind_param('i', $id_visita,);
					$query->execute();
					echo "<script>alert('Grazie per la sua valutazione'); location.href='appuntamenti.php';</script>";
				}
				else {
					array_push($errori, "Selezionare tutti i campi");
				}
			}
		?>
		<div id="container">
			<form action=<?php print '"feedback.php?id_visita='.$id_visita.'"'; ?>method="post">
				<p>L'appuntamento prenotato si è svolto:</p>		
				<input type="radio" name="feedback1" id="feedback11" value="In anticipo">
				<label for="feedback11">In anticipo</label>
				<br>
				<input type="radio" name="feedback1" id="feedback12" value="In orario">
				<label for="feedback12">In orario</label>
				<br>
				<input type="radio" name="feedback1" id="feedback13" value="In ritardo">
				<label for="feedback13">In ritardo</label>
				<br>
				<input type="radio" name="feedback1" id="feedback14" value="Molto in ritardo">
				<label for="feedback14">Molto in ritardo</label>
				<br>
				<p>Trovare il luogo della prestazione è stato:</p>		
				<input type="radio" name="feedback2" id="feedback21" value="Facile">
				<label for="feedback21">Facile</label>
				<br>
				<input type="radio" name="feedback2" id="feedback22" value="Ne facile ne difficile">
				<label for="feedback22">Né facile né difficile</label>
				<br>
				<input type="radio" name="feedback2" id="feedback23" value="Difficile">
				<label for="feedback23">Difficile</label>
				<br>
				<p>Le procedure della prestazione prenotata le sono state esposte in modo chiaro:</p>		
				<input type="radio" name="feedback3" id="feedback31" value="Si">
				<label for="feedback31">Sì</label>
				<br>
				<input type="radio" name="feedback3" id="feedback32" value="No">
				<label for="feedback32">No</label>
				<br>
				<p>Il personale si è comportato in maniera professionale:</p>		
				<input type="radio" name="feedback4" id="feedback41" value="Si">
				<label for="feedback41">Sì</label>
				<br>
				<input type="radio" name="feedback4" id="feedback42" value="No">
				<label for="feedback42">No</label>
				<br>
				<input type="submit" name="conferma" value="CONFERMA">
	     	</form>
	     	<?php include ('errori.php') ?>
	    </div> 		
 		<?php include ('footer.php') ?>
 	</body>
 </html>
