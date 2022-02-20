//Si generano i pulsanti degli orari escludendo quelli non validi
function generaOrari (periodo, inizio, fine, orariNonValidi) {
	for (var i = inizio*60 ; i < fine*60 ; i += periodo) {
        var ora = Math.trunc(i/60);
        var minuti = i%60 < 10 ? ("0" + i%60) : i%60;
        var orario = ora + ':' + minuti;
        if (!orariNonValidi.includes(orario)) {
            $('#orari').append('<input type="radio" name="orario" id="' + orario +'" value="' + orario + '">');
            $('#orari').append('<label for="' + orario + '">' + orario + '</label>');
        }
    }
}

$(document).ready(function(){
    //Necessario perchè #datepicker è creato dinamicamente
    $('body').on('focus', '#datepicker', function(){
        //Si toglie il precedente event "change" e se ne aggiunge uno nuovo
        $(this).off('change').change(function(){
            $('#orari').empty();
            //Variabili da passare in formato JSON
            var date = $(this).datepicker('getDate');
            var giornoSettimana = date.getDay();
            $('#giornoSettimana').val(giornoSettimana);
            var giorno = date.getDate() < 10 ? ("0" + date.getDate()) : date.getDate();
            var mese = (date.getMonth() + 1) < 10 ? ("0" + (date.getMonth() + 1)) : (date.getMonth() + 1);
            var anno = date.getFullYear();
            var data = anno + '-' + mese + '-' + giorno;
            var esame = $('input[name=esame]:checked').val();
           	var selezionato = {esame: esame, data: data};
            // Si richiedono gli orari non disponibili per la data selezionata
            $.getJSON('orariNonValidi.php', selezionato, function(result){
                // Si generano gli orari validi
                $('#orari').append('<p>Selezionare un orario</p>');
                generaOrari(result['durata'], result['INIZIO_MATTINA'], result['FINE_MATTINA'], result['oreNonValide']);
                if (giornoSettimana != 6) {
                    generaOrari(result['durata'], result['INIZIO_POMERIGGIO'], result['FINE_POMERIGGIO'], result['oreNonValide']);
                }
                // Generazione pulsante di conferma
                $('#orari').append('<input type="submit" name="conferma" value="CONFERMA">');
            });
        });
    });
});