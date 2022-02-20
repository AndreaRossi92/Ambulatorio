<?php include ('connessione_database.php') ?>

<?php
//Ricezione dati dal form di registrazione
if(isset($_POST['login'])) {
	if(empty($_POST['username'])) {array_push($errori, "Inserire un username");}
	if(empty($_POST['password'])) {array_push($errori, "Inserire una password");}
	
	//Controllo se esiste l'account con le credenziali inserite
	if($query = $mysqli->prepare('SELECT * FROM utenti WHERE username = ?')) {
		$query->bind_param('s', $_POST['username']);
		$query->execute();
		$query->store_result();
		if($query->num_rows > 0) {
			$query->bind_result($id, $codFiscale, $email, $telefono, $username, $password);
			$query->fetch();
			if(md5($_POST['password']) == $password) {

				//Se username e password sono corretti creo la sessione dell'utente e lo reindirizzo alla pagina di prenotazione
				session_regenerate_id();
				$_SESSION['loggato'] = TRUE;
				$_SESSION['id'] = $id;
				$_SESSION['username'] = $username;
				$_SESSION['codFiscale'] = strtoupper($codFiscale);
				$_SESSION['email'] = $email;
				$_SESSION['telefono'] = $telefono;
				$_SESSION['password'] = $_POST['password'];
				header('location: home.php');
			}
			else {
				//Password non valida
				array_push($errori, "Username e/o password non validi");
			}
		}
		else {
			//Username non valido
			array_push($errori, "Username e/o password non validi");
		}	
	}
	else {
		echo "<script type='text/javascript'>alert('Errore nella lettura del database');</script>";
	}
	$query->close();
}
?>