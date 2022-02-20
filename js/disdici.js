$(document).ready(function(){
	//Necessario perchè il pulsante "disdici" è generato dinamicamente
	$('body').on('focus', 'input[name="disdici"]', function(){
		$(this).click(function() {
	   		var id_visita = {id_visita: this.id};
	   		if(confirm("Vuoi disdire il tuo appuntamento?")) {
	   			//Si passa l'id della visita al file php che provvederà a cancellarla dal database
	   			$.getJSON('disdici.php', id_visita, function(){});
	   			alert("Appuntamento annullato con successo");
	   			//La visita viene rimossa dalla tabella
	   			var element = $('#' + this.id).closest('tr');
	   			element.remove();
	   		}
	    });
	});
});