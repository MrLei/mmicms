$(document).ready(function() {
	$('#navigation-list').sortable({
		update: function(event, ui) {
			$.get(request.baseUrl + "/cms/admin-navigation/sort/order/" + $(this).sortable('serialize'),
				function(result) {
					if (result) {
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