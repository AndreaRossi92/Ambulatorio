$(document).ready(function(){
   	$('input[name="elimina"]').click(function(){
   		var ok = confirm("Confermi di voler eliminare l'account?");
   		if(ok) {
	   		//Si passa l'id dell'utente alla pagina di eliminazione dell'account
	   		var id_utente = this.id;
	   		location.href='elimina_account.php?id_utente=' + id_utente;
	   	}
   	});
});