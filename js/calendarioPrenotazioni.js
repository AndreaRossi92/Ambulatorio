$(document).ready(function(){
    //Generazione del calendario dopo aver cliccato sull'esame desiderato
    $('input[name="esame"]').click(function(){
        $('#data').empty();
        $('#data').append('<p>Selezionare la data</p>');
        $('#data').append('<input type="text" id="datepicker" name="datepicker" readonly required>');
        $('#data').append('<input type="hidden" id="giornoSettimana" name="giornoSettimana">');
        $("#orari").empty();

        //Si richiedono le date non valide
        var esame = $('input[name=esame]:checked').val();
        $.getJSON('dateNonValide.json', function(result){
            // Inizializzazione variabili per la gestione del calendario
            var domani = new Date();
            domani.setDate(domani.getDate() + 1);
            // Distruzione del calendario
            $("#datepicker").datepicker("destroy");
            // Creazione calendario in italiano
            datepickerIta();
            $("#datepicker").datepicker({
                minDate: domani,
                maxDate: '+100D',
                dateFormat: 'dd/mm/yy',
                // Si anneriscono i giorni festivi o al completo
                beforeShowDay : function (date) {
                    var giornoSettimana = date.getDay();
                    var giorno = date.getDate() < 10 ? ("0" + date.getDate()) : date.getDate();
                    var mese = (date.getMonth() + 1) < 10 ? ("0" + (date.getMonth() + 1)) : (date.getMonth() + 1);
                    var anno = date.getFullYear();
                    var data = anno + '-' + mese + '-' + giorno;
                    if (giornoSettimana == 0 || result[esame].includes(data)) {
                        return [false];
                    }
                    else {
                        return [true];
                    }
                }
            });
        });
    });
});