$(document).ready(function() {
	initAcl();
});

function initAcl() {
	$('.rule-select').change(
		function() {
			var id = $(this).attr('id');
			id = id.split('-');
			var value = $(this).attr('value');
			$.get(
				request.baseUrl + "/cms/adminAcl/update/id/" + $(this).attr('id') + "/value/" + value,
				function(result) {
					if (result != '1') {
						alert(result);
					} else {
						if (value == 'allow') {
							$('#rule-policy-' + id[2]).removeClass('deny');
							$('#rule-policy-' + id[2]).addClass('allow');
						} else if (value == 'deny') {
							$('#rule-policy-' + id[2]).removeClass('allow');
							$('#rule-policy-' + id[2]).addClass('deny');
						}

					}
				}
			);
		}
	)

	$('a.remove-rule').click(
		function ()
		{
			var id = $(this).attr('id');
			id = id.split('-');
			if (window.confirm($(this).attr('title') + '?')) {
				$.get(
					request.baseUrl + "/cms/adminAcl/delete/id/" + id[2],
					function(result) {
						if (result != '1') {
							alert(result);
						} else {
							$('#rule-row-' + id[2]).remove();
						}
					}
				);
			}
		}
	);

	$('a.add-rule').click(
		function ()
		{
			alert('@TODO: dodawanie');
		}
	);

}