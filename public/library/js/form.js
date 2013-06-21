/*jslint unparam: true */
/*global document, $, jQuery, id, request */

function urlencode(str) {
	"use strict";
	str = str + '';
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

function fieldValidationOnBlur(element) {
	"use strict";
	var param = '',
		fid = $(element).attr('id'),
		formId = fid.substr(0, fid.indexOf('_', 0)),
		name = fid.substr(fid.indexOf('_', 0) + 1),
		errorsId = formId + '_' + name + '_errors';
	if (typeof (id) !== 'undefined') {
		param = '/id/' + id;
	}
	$.post(
		request.baseUrl + '/' + request.lang + '/cms/form/validate' + param,
		{
			'ctrl': $('#' + formId + '__ctrl').val(),
			'field': name,
			'value': urlencode($(element).val())
		},
		function (result) {
			if (result) {
				$('#' + errorsId).parent().addClass('error');
			} else {
				$('#' + errorsId).parent().removeClass('error');
			}
			$('#' + errorsId).html(result);
		});
}

$(document).ready(function () {
	"use strict";
	$('.validate').blur(function () {
		fieldValidationOnBlur(jQuery(this));
	});

	$('div.antirobot > input').val('js-' + $('div.antirobot > input').val() + '-js');
});