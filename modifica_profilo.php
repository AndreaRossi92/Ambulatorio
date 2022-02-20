<?php include('connessione_database.php') ?>
<?php include('loggato.php') ?>

<?php
	if(isset($_POST['modifica'])) {
		//Si selezionano i dati dell'utente	
		if($query = $mysqli->prepare('SELECT email, telefono, password FROM utenti WHERE id = ?')) {
			$query->bind_param('i', $_SESSION['id']);
			$query->execute();
			$query->store_result();
			$query->bind_result($email, $telefono, $password);
			$query->fetch();
			//Si controlla se la password inserita coincide con quella dell'utente
			if(md5($_POST['password']) == $password) {
				header('location: registrazione.php?modifica=TRUE');
			}
			else {
				//Password non valida
				array_push($errori, "Password non valida");
			}
		}
		else {
			echo "<script type='text/javascript'>alert('Errore nella lettura del database');</script>";
		}
		$query->close();
	}
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<title>Modifica Profilo</title>
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/buttons.css">
		<link rel="stylesheet" type="text/css" href="css/errori.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
	</head>
	<body>
		<?php include ('header2.php') ?>
		<div id="container">
	 		<form action="modifica_profilo.php" method="post">
	 			<label for="password">Inserisci la password</label>
	 			<input type="password" name="password" placeholder="Password" id="password" required>
	 			<input type="submit" name="modifica" value="CONFERMA">
	 		</form>
	 		<?php include ('errori.php') ?>
 		</div>
 		<?php include ('footer.php') ?>
 	</body>
 </html>