//Variabili contenenti domande, risposte e colori dei grafici
var risposte = {
	orario: ["In anticipo", "In orario", "In ritardo", "Molto in ritardo"],
	luogo: ["Facile", "Ne facile ne difficile", "Difficile"],
	procedura: ["Si", "No"],
	personale: ["Si", "No"]
}

var domande = {
	orario: "L'appuntamento prenotato si è svolto:",
	luogo: "Trovare il luogo della prestazione è stato:",
	procedura: "Le procedure della prestazione prenotata le sono state esposte in modo chiaro:",
	personale: "Il personale si è comportato in maniera professionale:"
}

var colori = {
	orario: ["#00ff00", "#00aa00", "#00ffff", "#ff0000"],
	luogo: ["#00ff00", "#ffff00", "#ff0000"],
	procedura: ["#00ff00", "#ff0000"],
	personale: ["#00ff00", "#ff0000"]
}

//Si genera la tabella relativa a una domanda
function generaTabella (domanda, sum) {
	$('#dati').append('<div id="' + domanda + '"><p>' + domande[domanda] + '</p><table><thead><tr><th>Risposta</th><th></th><th>%</th><th>N° utenti</th></tr></thead><tbody></tbody><tfoot><tr><td colspan="3">Totale utenti:</td><td>' + sum + '</td></tr></tfoot></table></div>');
}

//Si generano le righe di una tabella
function generaRiga (result, domanda, risposta, sum, colore) {
	//Se ci sono feedback per gli esami e le date selezionate
	if(result.length != 0) {
		//Variabile contenente il numero di una certa risposta a una certa domanda
		var conta = risposta in result[domanda] ? result[domanda][risposta] : 0;
	}
	else {
		var conta = 0;
	}
	
	//Evita la divisione per 0 nel caso non siano presenti risposte
   	if(sum == 0) {
   		sum = 1;
   	}

	//Generazione della riga
	$('#' + domanda).find('tbody').append('<tr id="tr-'+ domanda.replace(/ /g,'') + '-' + risposta.replace(/ /g,'') + '"></tr>');
	$('#' + domanda).find('#tr-' + domanda.replace(/ /g,'') + '-' + risposta.replace(/ /g,'')).append('<td>' + risposta + '</td>');
	$('#' + domanda).find('#tr-' + domanda.replace(/ /g,'') + '-' + risposta.replace(/ /g,'')).append('<td><div id="td-' + domanda + '-' + risposta.replace(/ /g,'') +'"></div></td>');
	$('#td-' + domanda + '-' + risposta.replace(/ /g,'')).css({'width': (conta/sum).toFixed(2)*200 + 'px', 'background-color': colore});
	$('#td-' + domanda + '-' + risposta.replace(/ /g,'')).css('border', '1px solid black');
	$('#' + domanda).find('#tr-' + domanda.replace(/ /g,'') + '-' + risposta.replace(/ /g,'')).append('<td>'+ (conta/sum*100).toFixed(2) + '</td>');
	$('#' + domanda).find('#tr-' + domanda.replace(/ /g,'') + '-' + risposta.replace(/ /g,'')).append('<td>' + conta + '</td>');
}

//Si generano tutti i grafici della pagina
function generaGrafici () {
	$('#dati').empty();
	var dataIniziale = $('#dataIniziale').val();
	var dataFinale = $('#dataFinale').val();
	var esami = [];
	//Si crea un array contenente gli esami selezionati
	$('input[name="esame"]:checked').each(function () {
       	esami.push($(this).attr('id'));
   	});
   	//Si richiedono il numero di risposte ad ogni domanda per gli esami e le date selezionate
   	var jsonData = {dataIniziale: dataIniziale, dataFinale: dataFinale, esami: esami}
   	$.getJSON('feedbackData.php', jsonData, function(result){
   		for (var domanda in risposte) {
   			//Calcolo del totale delle risposte ad una domanda
   			var sum = 0;
   			for (var risposta in result[domanda]) {
   				sum += result[domanda][risposta];
   			}
   			
   			//Generazione tabella di una domanda
   			generaTabella(domanda, sum);
   			//Generazione delle righe della tabella
   			for (var i = 0 ; i < risposte[domanda].length ; i++) {
   				generaRiga(result, domanda, risposte[domanda][i], sum, colori[domanda][i]);
   			}
   		}
	});
}

$(document).ready(function(){
	//Quando si cambia la selezione degli esami
	$('input[name=esame]').change(function() {
		//Se c'è almeno un esame selezionato ed è già inserito un intervallo di date si generano i grafici
		if ($('#dataIniziale').val() != "" && $('#dataFinale').val() != "" && $('input[name=esame]:checked').length) {
			generaGrafici();
		}
		//Altrimenti si eliminano i grafici
		else {
			$('#dati').empty();
		}
	});

	//Quando si cambia la data finale si esegue quanto fatto nel caso precedente
	//(Il caso in cui viene cambiata la data iniziale è all'interno del file js calendarioFeedback)
	$('#dataFinale').change(function(){
		if ($('#dataIniziale').val() != "" && $('#dataFinale').val() != "" && $('input[name=esame]:checked').length) {
			generaGrafici();
		}
		else {
			$('#dati').empty();
		}
	});
});