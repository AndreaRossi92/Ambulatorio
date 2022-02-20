var currentday = "";

$(document).ready(function(){
    //Generazione calendario in italiano
    datepickerIta();
    $("#dataIniziale").datepicker({
        dateFormat: "dd/mm/yy",
        onSelect: function (dateText, inst) {
            currentday = dateText;
            //Se il giorno iniziale selezionato è > del giorno finale, si vuota la casella contente il giorno finale e si eliminano i grafici
            if ($("#dataFinale").val() != "" && currentday > $("#dataFinale").val()) {
                $("#dataFinale").val("");
                $("#dati").empty();
            }
            //Il giorno finale è selezionabile solo dalla data iniziale selezionata in poi
            //Se il giorno finale è già inserito e c'è almeno un esame selezionato, si generano i grafici
            $("#dataFinale").datepicker("option", { minDate: currentday });
            if ($('#dataIniziale').val() != "" && $('#dataFinale').val() != "" && $('input[name=esame]:checked').length) {
                generaGrafici();
            }
            //Altimenti si eliminano i grafici
            else {
                $('#dati').empty();
            }
        }
    });
      
    $("#dataFinale").datepicker({
        dateFormat: "dd/mm/yy"
    });
});