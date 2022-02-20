function generaAppuntamenti () {
    //Cambio formato data
    var dataItaliana = $('#datepicker').val();
    var array = dataItaliana.split('/');
    var data = array[2] + '-' + array[1] + '-' + array[0];
    var esami = [];
    //Si inseriscono gli esami selezionati in un array
    $('input[name="esame"]:checked').each(function ()
    {
        esami.push($(this).val());
    });
    //Si richiedono i dati degli esami selezionati relativi alla data selezionata
    var jsonData = {data: data, esami: esami}
    $.getJSON('appuntamentiAdmin.php', jsonData, function(result){
        //Si crea la tabella contente i dati ottenuti
        $('.tabella tbody').empty();
        for(var i=0 ; i<result.length ; i++) {
            $('.tabella tbody').append('<tr>');
            for(var key in result[i]) {
                if(key != 'id'){
                    $('.tabella tbody tr:nth-child('+ (i+1) + ')').append('<td>' + result[i][key] + '</td>');
                }
            }
            var oggi = new Date();
            var giorno = oggi.getDate() < 10 ? ("0" + oggi.getDate()) : oggi.getDate();
            var mese = (oggi.getMonth() + 1) < 10 ? ("0" + (oggi.getMonth() + 1)) : (oggi.getMonth() + 1);
            var anno = oggi.getFullYear();
            oggi = anno + '-' + mese + '-' + giorno
            //Se la data selezionata è >= alla data odierna, si genera il pulsante per la disdetta degli esami
            if(data >= oggi) {
                $('.tabella tbody tr:nth-child('+ (i+1) + ')').append('<td><input type="button" name="disdici" id="' + result[i]['id'] + '" value="DISDICI"></td>');
            }
            $('.tabella tbody').append('</tr>');
        }
    });
}

$(document).ready(function(){
    //Necessario perchè #datepicker viene generato dinamicamente e non è presente al momento della creazione della pagina
    $('body').on('focus', '#datepicker', function(){

        // Creazione calendario in italiano
        datepickerIta();
        $(this).datepicker({
            dateFormat: 'dd/mm/yy'
        });

        //Se c'è almeno un esame selezionato, quando si cambia la data selezionata venogono generati gli appuntamenti
        $('#datepicker').on('change', function(){
            if ($('input[name=esame]:checked').length) {
                generaAppuntamenti();
            }
        });

        //Se c'è una data inserita, quando si cambia la selezione degli esami (e ci sia almeno un esame selezionato), si generano gli appuntamenti
        $('input[type="checkbox"]').on('change', function(){
            if ($('#datepicker').val().length && $('input[name=esame]:checked').length) {
                generaAppuntamenti();
            }
            //Altrimenti si svuota la tabella
            else {
                $('.tabella tbody').empty();
            }
        });
    });
});