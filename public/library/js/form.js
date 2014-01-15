/*jslint unparam: true */
/*global document, $, jQuery, id, request */

function urlencode(str) {
	"use strict";
	str = String(str);
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
				// Ukrycie dymka po kliknięciu
				$('#' + errorsId).show().click(function () {
					$(this).hide().parent().removeClass('error');
				});
			} else {
				$('#' + errorsId).parent().removeClass('error');
			}
			$('#' + errorsId).html(result);
		}
	);
}

function timeDecode(intTime) {
	"use strict";
	var hours = Math.floor(intTime / 60),
		minutes = intTime - (hours * 60);

	if (hours.toString().length === 1) {
		hours = "0" + hours.toString();
	}
	if (minutes.toString().length === 1) {
		minutes = "0" + minutes.toString();
	}
	return hours + ':' + minutes;
}

$(document).ready(function () {
	"use strict";
	var calcTimeSlider = function (event, ui) {
			var label = $(this).find('.float-label'),
				startPosition = label.data('startPosition'),
				position;
			if (!startPosition) {
				label.data('startPosition', label.css('right'));
				startPosition = label.css('right');
			}
			position = parseInt(startPosition, 10) + (10 - Math.round(parseFloat(label.parent()[0].style.width) / 10)) * -1;
			if (ui && ui.hasOwnProperty('value')) {
				label.text(ui.value + ' h');
				$(this).parent().find('.sliderTo').hide();
				$(this).parents('div:first').find('input:first').val(ui.value).trigger('change');
			}
			label.css('right', position + 'px');
		},
		calcRangeTimeSlider = function (event, ui) {

		};

	$('.validate').blur(function () {
		fieldValidationOnBlur(jQuery(this));
	});
	$('div.errors').each(function () {
		$(this).click(function () {
			$(this).hide().parent().removeClass('error');
		});
	});
	$('div.antirobot > input').val('js-' + $('div.antirobot > input').val() + '-js');

	// Obsługa standardowego pola autocomplete generowanego przez backend php
	$('input[type="text"][data-source]').each(function () {
		var url = $(this).attr('data-source');
		$(this).autocomplete({
			source: url,
			open: function () {
				$(this).removeClass('ui-corner-all').addClass('ui-corner-top');
			},
			close: function () {
				$(this).removeClass('ui-corner-top').addClass('ui-corner-all');
			}
		});
	});

	// TimeSlider
	$('.js-time-slider').each(function () {
		var element = $(this);
		element.slider({
			range:	'min',
			value:	parseInt(element.attr('data-value'), 10),
			min:	parseInt(element.attr('data-min'), 10),
			max:	parseInt(element.attr('data-max'), 10),
			step:	parseInt(element.attr('data-step'), 10),
			slide:	calcTimeSlider
		}).
			find('div.ui-slider-range').
			html('<div class="float-label"></div>');
		calcTimeSlider.apply(element);
	});

	// RangeTimeSlider

});