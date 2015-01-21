$(document).ready(function () {
	
	$('.section').sortable({
		items: '> div.placeholder',
		opacity: 0.5,
		axis: 'x',
		placeholder: 'holder',
		start: function (event, ui) {
			$('.holder').addClass(ui.item[0].className);
		}
	});
	
	$('div').sortable({
		items: '> section',
		opacity: 0.5,
		axis: 'y',
		placeholder: 'holder section',
	});
	
    $('div.placeholder').resizable({
		handles: 'e',
		create: function (event, ui) {
			$(this).resizable('option', 'grid', $(this).parent().width() / 12);
		},
		resize: function (event, ui) {
			//obliczanie bieżącej szerokości
			var currentWidth = Math.round($(this).width() / ($(this).parent().width() / 12));
			var pool = currentWidth;
			
			//czyszczenie css po obliczeniach na podstawie rozmiaru
			$(this).parent().find('div.placeholder').removeAttr('data-current');
			$(this).parent().find('div.placeholder').removeAttr('style');

			$(this).attr('data-current', 'current')

			//obliczanie puli wolnego miejsca w sekcji
			$(this).parent().find('> div.placeholder').each(function () {
				if (!$(this).attr('data-current')) {
					pool = pool + parseInt($(this).attr('class').match(/span\-([1-9]|10|11|12)\-of\-12/)[1]);
				}
			});
			
			//przestawienie szerokości jeśli > 1 i nie przepełnia puli
			if (currentWidth > 0 && pool < 13) {
				$(this).removeAttr('class');
				$(this).addClass('placeholder ui-resizable span-' + currentWidth + '-of-12');
			}
		}
    });
	
	$('div.placeholder').droppable({
		
	});
	
	$('.section, div.placeholder').on('dblclick', function () {
		$(this).remove();
		return false;
	});
	
	$('#cms-page-composer').addClass('compose');
	
});