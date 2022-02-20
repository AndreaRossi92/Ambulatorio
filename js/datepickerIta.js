//Calendario in italiano
function datepickerIta() {
	$.datepicker.regional['it'] = {
		closeText: 'Chiudi',
	    prevText: '',
	    nextText: '',
	    currentText: 'Oggi',
	    monthNames: ['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno', 'Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'],
	    monthNamesShort: ['Gen','Feb','Mar','Apr','Mag','Giu', 'Lug','Ago','Set','Ott','Nov','Dic'],
	    dayNames: ['Domenica','Lunedì','Martedì','Mercoledì','Giovedì','Venerdì','Sabato'],
	    dayNamesShort: ['Dom','Lun','Mar','Mer','Gio','Ven','Sab'],
	    dayNamesMin: ['Dom','Lun','Mar','Mer','Gio','Ven','Sab'],
	    beforeShow: function (input, inst) {
	        var rect = input.getBoundingClientRect();
	        setTimeout(function () {
	            inst.dpDiv.css({ top: rect.top + 20, left: rect.left - 5 });
	        }, 0);
	    }
	}
	$.datepicker.setDefaults($.datepicker.regional['it']);
}