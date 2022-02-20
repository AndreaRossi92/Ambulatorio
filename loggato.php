<?php
	if (!isset($_SESSION['loggato'])) {
		header('location: index.php');
		exit;
	}
?>