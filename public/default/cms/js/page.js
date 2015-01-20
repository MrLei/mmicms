$(document).ready(function () {
	
	$('#cms-page-composer > .section').sortable({
		items: '> div.placeholder',
		opacity: 0.5,
		tolerance: "pointer",
		scrollSensitivity: 10,
		axis: 'x',
		scroll: true,
		placeholder: 'holder',
		start: function (event, ui) {
			$('.holder').addClass(ui.item[0].className);
		}
	});
	
	$('#cms-page-composer').sortable({
		items: '> section',
		opacity: 0.5,
		tolerance: "pointer",
		scrollSensitivity: 10,
		axis: 'y',
		forceHelperSize: true,
		scroll: true,
		forcePlaceholderSize: true,
		placeholder: 'holder section'
	});
    $('div.placeholder').resizable({
		minHeight: '100%',
		maxHeight: '100%',
		handles: 'e, w',
		containment: 'parent',
		create: function (event, ui) {
			$(this).resizable('option', 'grid', $(this).parent().width() / 12);
		},
		resize: function (event, ui) {
			$(this).attr('class', '');
			var currentWidth = Math.round($(this).width() / ($(this).parent().width() / 12));
			$(this).addClass('placeholder ui-resizable span-' + currentWidth + '-of-12');
			$(this).attr('data-current', 'current')
			$(this).parent().find('div.placeholder').attr('style', '');
			var pool = currentWidth;
			$(this).parent().find('div.placeholder').each(function () {
				if (!$(this).attr('data-current')) {
					console.log($(this));
				}
			});
			$(this).parent().find('div.placeholder').removeAttr('data-current');
		}
		
    });
	
	$('#cms-page-composer').addClass('compose');
	
});