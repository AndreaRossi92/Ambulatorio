$(document).ready(function(){
   	$('input[name="feedback"]').click(function(){
   		//Si passa l'id della visita alla pagina del feedback
   		var id_visita = this.id;
   		location.href='feedback.php?id_visita='+id_visita;
   	});
});