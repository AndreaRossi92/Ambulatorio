<?php include('validazione_reg.php') ?>

<?php
	if(isset($_GET['modifica']) && isset($_SESSION['loggato'])) {
		$modifica = TRUE;
	}
	else {
		$modifica = FALSE;
	}
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<title>Profilo</title>
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/buttons.css">
		<link rel="stylesheet" type="text/css" href="css/errori.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="js/eliminaAccount.js"></script>
	</head>
	<body>
		<?php 
			if (!$modifica) {
				include ('header.php');
			}
			else {
				include ('header2.php');
			}
		?>
		<h3>Profilo</h3>
		<div id="container">
	 		<form action= <?php if($modifica) {print '"registrazione.php?modifica=TRUE"';} else {print '"registrazione.php"';} ?> method="post">
	 			<label for="codFiscale">Codice Fiscale</label>
	 			<input type="text" name="codFiscale" placeholder="Codice Fiscale" id="codFiscale" required <?php if($modifica) {print 'value="'.$_SESSION['codFiscale'].'">';} else {print '>';} ?>
	 			<label for="email">E-mail</label>
	 			<input type="email" name="email" placeholder="E-mail" id="email" required <?php if($modifica) {print 'value="'.$_SESSION['email'].'">';} else {print '>';} ?>
	 			<label for="telefono">Telefono</label>
	 			<input type="tel" name="telefono" placeholder="Telefono" id="telefono" required <?php if($modifica) {print 'value="'.$_SESSION['telefono'].'">';} else {print '>';} ?>
	 			<label for="username">Username</label>
	 			<input type="text" name="username" placeholder="Username" id="username" required <?php if($modifica) {print 'value="'.$_SESSION['username'].'">';} else {print '>';} ?>
	 			<label for="password_1">Password</label>
	 			<input type="password" name="password_1" placeholder="Password" id="password_1" required <?php if($modifica) {print 'value="'.$_SESSION['password'].'">';} else {print '>';} ?>
	 			<label for="password_2">Conferma Password</label>
	 			<input type="password" name="password_2" placeholder="Conferma password" id="password_2" required <?php if($modifica) {print 'value="'.$_SESSION['password'].'">';} else {print '>';} ?>
	 			<?php if($modifica) {print '<input type="submit" name="modifica" value="MODIFICA">';} else {print '<input type="submit" name="registrazione" value="REGISTRATI">'; } ?>
	 			<?php if(($modifica) && $_SESSION['username'] != 'admin') {print '<input type="button" id="' . $_SESSION['id'] . '" name="elimina" value="ELIMINA ACCOUNT">';} ?>
	 		</form>
	 		<br>
	 		<?php if (!$modifica) {print '<p>Hai già effettuato la registrazione? Clicca <a href="login.php">qui</a> per accedere</p>';} ?>
	 		<?php include ('errori.php') ?>
	 	</div> 		
 		<?php include ('footer.php') ?>
 	</body>
 </html>