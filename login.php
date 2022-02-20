<?php include('validazione_login.php') ?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/buttons.css">
		<link rel="stylesheet" type="text/css" href="css/errori.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
	</head>
	<body>
		<?php include ('header.php') ?>
		<h3>Login</h3>
		<div id="container">
	 		<form action="login.php" method="post">
	 			<label for="username">Username</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
	 			<label for="password">Password</label>
		 		<input type="password" name="password" placeholder="Password" id="password" required>	 				
	 			<input type="submit" name='login' value="LOGIN">
	 		</form>
	 		<br>
	 		<p>Non hai ancora effettuato la registrazione? Clicca <a href="registrazione.php">qui</a> per registrarti</p>
	 		<?php include ('errori.php') ?>
	 	</div>
 		<?php include ('footer.php') ?>
 	</body>
 </html>