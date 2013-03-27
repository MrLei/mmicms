$(document).ready(function () {

	$('.validate').blur(function () {
		var param = '';
		if (typeof(id) != 'undefined') {
			param = '/id/' + id;
		}
		var fid = $(this).attr('id');
		var formId = fid.substr(0, fid.indexOf('_', 0));
		var name = fid.substr(fid.indexOf('_', 0) + 1);
		var errorsId = formId + '_' + name + '_errors';
		$.post(
			request.baseUrl + '/' + request.lang + '/cms/form/validate' + param,
			{
				'ctrl': $('#' + formId + '__ctrl').val(),
				'field': name,
				'value': urlencode($(this).val())
			},
			function (result) {
				if (result) {
					$('#' + errorsId).parent().addClass('error');
				} else {
					$('#' + errorsId).parent().removeClass('error');
				}
				$('#' + errorsId).html(result);
			});
	});

	$('div.antirobot > input').val('js-' + $('div.antirobot > input').val() + '-js');

	function urlencode(str) {
		str = str.replace(',', '%2C');
		str = str.replace(' ', '+');
		str = str.replace('&', '%26');
		str = str.replace('~', '%7E');
		str = str.replace('?', '%3F');
		str = str.replace('=', '%3D');
		str = str.replace(';', '%3B');
		str = str.replace('\'', '%27');
		str = str.replace('"', '%22');
		return str;
	}

});