$(document).ready(function() {
	$('#property-list').sortable({
		update: function(event, ui) {
			$.get(request.baseUrl + "/cms/admin-property/order/data/" + $(this).sortable('serialize'),
				function(result) {
					if (result != '' && result != '1') {
						alert(result);
					}
				});
		}
	});

	$('a.confirm').click(function ()
	{
		return window.confirm($(this).attr('title'));
	});
});