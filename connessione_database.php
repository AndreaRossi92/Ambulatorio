<?php
	// Inizio sessione
	session_start();

	//Connessione al database
	$DATABASE_HOST = 'localhost';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = '';
	$DATABASE_NAME = 'ambulatorio';

	//Inizializzazione array di eventuali errori
	$errori = array();

	$mysqli = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
	if($mysqli->connect_error) {
		die('Errore connessione al database: '.$mysqli->connect_errno.' '.$mysqli->connect_error);
	}
?>