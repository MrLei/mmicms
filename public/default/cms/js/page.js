$(document).ready(function () {
	$('.section').sortable({
		opacity: 0.5,
		tolerance: "pointer",
		scrollSensitivity: 10,
		axis: 'x',
		forceHelperSize: true,
		scroll: true,
		forcePlaceholderSize: true,
		placeholder: 'holder'
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
		placeholder: 'holder'
	});
});