<?php include ('connessione_database.php') ?>

<?php
//Ricezione dati dal form di registrazione
if(isset($_POST['registrazione']) || isset($_POST['modifica'])) {
	//Controllo dei dati del form
	if(empty($_POST['codFiscale'])) {array_push($errori, "Inserire il codice fiscale");}
	if(empty($_POST['email'])) {array_push($errori, "Inserire un indirizzo e-mail");}
	if(empty($_POST['telefono'])) {array_push($errori, "Inserire un numero di telefono");}
	if(empty($_POST['username'])) {array_push($errori, "Inserire un username");}
	if(empty($_POST['password_1'])) {array_push($errori, "Inserire una password");}
	if (!(isset($_SESSION['username']) && ($_SESSION['username'] == "admin"))) {
		if(!preg_match("/^[A-Z]{6}\d{2}[A-Z]\d{2}[A-Z]\d{3}[A-Z]$/i", $_POST['codFiscale'])) {array_push($errori, "Codice fiscale non valido");}
	}
	if($_POST['password_1'] != $_POST['password_2']) {array_push($errori, "Le due password non coincidono");}
	if(!is_numeric($_POST['telefono'])) {array_push($errori, "Il numero di telefono deve contenere solo numeri");}
	
	//Controllo se esiste già un account con un certo username o email o numero di telefono
	if(isset($_POST['registrazione'])) {
		$stmt ="SELECT username, email, telefono FROM utenti WHERE username = ? OR email = ? OR telefono = ?";
	}
	if(isset($_POST['modifica'])) {
		$stmt = "SELECT username, email, telefono FROM utenti WHERE (username = ? OR email = ? OR telefono = ?) AND id <> '{$_SESSION['id']}'";
	}
	if($query = $mysqli->prepare($stmt)) {
		$query->bind_param('sss', $_POST['username'], $_POST['email'], $_POST['telefono']);
		$query->execute();
		$query->store_result();
		if($query->num_rows > 0) {
			$query->bind_result($username, $email, $telefono);
			while($query->fetch()) {
				if($username == $_POST['username']) {array_push($errori, "Username già in uso");}
				if($email == $_POST['email']) {array_push($errori, "La mail inserita risulta già registrata");}
				if($telefono == $_POST['telefono']) {array_push($errori, "Il numero di telefono inserito risulta già registrato");}
			}
		}

		//Query per inserire i dati di registrazione
		if(isset($_POST['registrazione'])) {
			$stmt ="INSERT INTO utenti (codFiscale, email, telefono, username, password) VALUES (?, ?, ?, ?, ?)";
		}
		//Query per aggiornare i dati del profilo in caso di modifica
		if(isset($_POST['modifica'])) {
			$stmt = "UPDATE utenti SET codFiscale = ?, email = ?, telefono = ?, username = ?, password = ? WHERE id = '{$_SESSION['id']}'";
		}

		//Se il form è valido inserisco o aggiorno i dati nel database
		if(count($errori) == 0) {
			if($query = $mysqli->prepare($stmt)) {
				$password = md5($_POST['password_1']);
				$codFiscale = strtoupper($_POST['codFiscale']);
				$query->bind_param('sssss', $codFiscale, $_POST['email'], $_POST['telefono'], $_POST['username'], $password);
				$query->execute();
				if(isset($_POST['registrazione'])) {
					echo "<script type='text/javascript'>alert('Registrazione effettuata correttamente.\\nAdesso è possibile effettuare il login.\\nVerrai reindirizzato alla home.');
						window.location.href='index.php';</script>";
				}
				if(isset($_POST['modifica'])) {
					session_destroy();
					echo "<script type='text/javascript'>alert('Le modifiche sono state salvate.\\nVerrai reindirizzato alla home e potrai effettuare nuovamente il login.');
						window.location.href='index.php';</script>";
				}
			}
			else {
				echo "<script type='text/javascript'>alert('Errore inserimento nel database');</script>";
			}
		}
	}
	else {
		echo "<script type='text/javascript'>alert('Errore nella lettura del database');</script>";
	}
}
?>