<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<title>Manuale utente</title>
		<link rel="stylesheet" type="text/css" href="css/main.css">
	</head>
	<body>
		<?php include ('header.php') ?>
		<div id="container">
			<h3>Registrazione e login</h3>
			<p>Per effettuare la registrazione premere sul pulsante "Registrazione" sulla home page o sul menù in alto.
				Una volta registrati è possibile effettuare il login con le proprie credenziali premendo sul pulsante "Login" sulla home page
				o sul menù in alto.</p>
			<hr>
			<h4>Dopo aver effettuato l'accesso è possibile svolgere le seguenti funzioni premendo sul relativo pulsante:</h4>
			<br>
			<h3>Funzionalità utente:</h3>
			<h4>Prenota</h4>
			<p>Selezionare l'esame desiderato, dopodichè selezionare una data e un orario tra quelli disponibili mostrati.
				Premere il tasto conferma per effettuare la prenotazione.</p>
			<h4>Appuntamenti</h4>
			<p>Vengono visualizzati tutti gli esami prenotati. E' possibile disdire un esame entro 2 giorni dalla data prenotata premendo il
				pulsante "Disdici" accanto all'esame (il pulsante verrà visualizzato solo entro il termine precedentemente indicato).
				E' possibile dare un feedback sugli esami effettuati antecedenti alla data odierna premendo il pulsante "Valuta" accanto
				al relativo esame. Una volta inviato il feedback, l'esame avrà accanto la dicitura "Valutato".</p>
			<h4>Referti</h4>
			<p>Vengono visualizzati gli esami di cui è disponibile il referto. Cliccare sul nome dell'esame desiderato per scaricare
				il referto corrispondente.</p>
			<h4>Modifica profilo</h4>
			<p>Verrà richiesto di inserire la password del proprio account, dopodiché verranno mostrati i dati del proprio profilo e sarà
				possibile modificarli cliccando sui campi desiderati. Una volta modificati i dati verrà richiesto di effettuare
				nuovamente l'accesso.</p>
			<h4>Logout</h4>
			<p>Viene effettuato il logout e si verrà reindirizzati alla pagina principale.</p>
			<br>
			<h3>Funzionalità admin:</h3>
			<h4>Prenota</h4>
			<p>Inserire il codice fiscale dell'utente di cui si vuole registrare la prenotazione. Selezionare l'esame desiderato,
				dopodichè selezionare una data e un orario tra quelli disponibili mostrati.
				Premere il tasto conferma per effettuare la prenotazione.</p>
			<h4>Appuntamenti</h4>
			<p>Vengono visualizzati tutti gli esami prenotati. E' possibile disdire un esame premendo il pulsante "Disdici" accanto all'esame 
				(il pulsante verrà visualizzato solo per gli esami dalla data odierna in poi).</p>
			<h4>Gestione esami</h4>
			<p>E' possibile bloccare/sbloccare la prenotazione degli esami per determinati giorni. Selezionare l'esame di cui si
				vogliono bloccare/sbloccare le prenotazioni, dopodichè selezionare i giorni da bloccare/sbloccare. I giorni bloccati
				appariranno evidenziati. Cliccando su un giorno non bloccato, questo verrà evidenziato. Cliccando su un giorno
				bloccato questo non sarà più evidenziato. Una volta scelte le date da bloccare/sbloccare, premere il tasto "Conferma".</p>
			<h4>Feedback</h4>
			<p>E' possibile visualizzare i dati relativi ai feedback dati dagli utenti. Selezionare uno o più esami e l'intervallo
				di date di cui si vuole il feedback. Verranno visualizzati dei grafici con i dati corrispondenti.</p>
			<h4>Modifica profilo</h4>
			<p>Verrà richiesto di inserire la password del proprio account, dopodiché verranno mostrati i dati del proprio profilo e sarà
				possibile modificarli cliccando sui campi desiderati. Una volta modificati i dati verrà richiesto di effettuare
				nuovamente l'accesso.</p>
			<h4>Logout</h4>
			<p>Viene effettuato il logout e si verrà reindirizzati alla pagina principale.</p>
		</div>
		<?php include ('footer.php') ?>
	</body>
</html>