var dateSelezionate = new Array();

// Aggiunge una data se assente o la rimuove se presente
function modificaData(date) {
    var index = $.inArray(date, dateSelezionate);
    if (index >= 0) {
        dateSelezionate.splice(index, 1);
    }
    else {
        dateSelezionate.push(date);
    }
}

$(document).ready(function(){
    //Quando viene cliccato un esame
    $('input[name="esame"]').click(function(){
        $("#date").empty();
        $("#date").append('<p>Scegliere le date da bloccare/sbloccare</p>');
        $("#date").append('<div id="datepicker"></div>');
        //Si richiedono le date bloccate dell'esame selezionato
        var selezionato = {esame: $('input[name="esame"]:checked').attr('id')};
        $.getJSON('dateBloccate.php', selezionato, function(result){
            var domani = new Date();
            domani.setDate(domani.getDate() + 1);
            dateSelezionate = result.slice();
            $("#datepicker").datepicker("destroy");
            //Generazione calendario
            datepickerIta();
            $("#datepicker").datepicker({
                minDate: domani,
                maxDate: '+100D',
                dateFormat: 'yy-mm-dd',
                //Le date cliccate vengono bloccate o sbloccate
                onSelect: function (dateText, inst) {
                    modificaData(dateText);
                },
                beforeShowDay: function (date) {
                    //Vengono mostrati i giorni bloccati dell'esame scelto
                    var giornoSettimana = date.getDay();
                    var giorno = date.getDate() < 10 ? ("0" + date.getDate()) : date.getDate();
                    var mese = (date.getMonth() + 1) < 10 ? ("0" + (date.getMonth() + 1)) : (date.getMonth() + 1);
                    var anno = date.getFullYear();
                    var data = anno + '-' + mese + '-' + giorno;

                    var controllaData = $.inArray(data, dateSelezionate);
                    if(giornoSettimana == 0) {
                        return[false];
                    }
                    else if (controllaData >= 0) {
                        return [true, "ui-state-highlight"];
                    }
                    return [true, ""];
                }
            });
        });
        $('#button').empty();
        $('#button').append('<input type="button" id="modificaDate" value="CONFERMA">');
    });
});