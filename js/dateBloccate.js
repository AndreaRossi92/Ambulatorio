$(document).ready(function(){
	//Necessario perchè #modificaDate è creato dinamicamente
	$('body').on('focus', '#modificaDate', function(){
		//Si passano l'esame e le relative date bloccate al file php che le inserirà nel database
		$(this).click(function(){
			window.location.href="inserimento_dateBloccate.php?esame=" + $('input[name="esame"]:checked').attr('id') + "&date=" + dateSelezionate;
		});
	});
});