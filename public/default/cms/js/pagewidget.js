$(document).ready(function () {
	initPageWidget();
});

function initPageWidget() {
	$('.widget-checkbox').change(
			function () {
				var id = $(this).attr('id');
				id = id.split('-');
				var value = $(this).is(':checked');
				$.get(
						request.baseUrl + "/cms/adminPageWidget/update/id/" + $(this).attr('id') + "/value/" + value,
						function (result) {
							if (result != '1') {
								alert('Problem ze zmianą właściwości');
							}
						}
				);
			}
	)

	$('a.remove-widget').click(
			function ()
			{
				var id = $(this).attr('id');
				id = id.split('-');
				if (window.confirm($(this).attr('title') + '?')) {
					$.get(
							request.baseUrl + "/cms/adminPageWidget/delete/id/" + id[2],
							function (result) {
								if (result != '1') {
									alert(result);
								} else {
									$('#widget-row-' + id[2]).remove();
								}
							}
					);
				}
			}
	);

}