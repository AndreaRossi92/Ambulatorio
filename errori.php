<?php
	//Si stampano a schermo eventuali errori
	if(count($errori) > 0) {
		echo "<div>";
		foreach($errori as $errore) {
			echo "<p id='errore'>".$errore."</p>";
		}
		echo "</div>";
	}
?>