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
	var param		= '',
		fieldValue	= $(element).val(),
		fid			= $(element).attr('id'),
		formId		= fid.substr(0, fid.indexOf('_', 0)),
		name		= fid.substr(fid.indexOf('_', 0) + 1),
		errorsId	= formId + '_' + name + '_errors';
	if ('undefined' !== typeof id) {
		param = '/id/' + id;
	}
	if ('checkbox' === $(element).attr('type') && !$(element).prop('checked')) {
		fieldValue = '0';
	}
	$.post(request.baseUrl + '/cms/form/validate' + param,
		{ctrl: $('#' + formId + '__ctrl').val(), field: name, value: urlencode(fieldValue)},
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
			var inputMin = $(this).parents('div:first').find('input[id$="_min"]:first'),
				inputMax = $(this).parents('div:first').find('input[id$="_max"]:first');
			if (ui && ui.hasOwnProperty('value')) {
				$(this).parent().find('.sliderFrom.min').text(timeDecode(ui.values[0]));
				$(this).parent().find('.sliderTo.max').text(timeDecode(ui.values[1]));
				inputMin.val(ui.values[0]).trigger('change');
				inputMax.val(ui.values[1]).trigger('change');
			} else {
				$(this).parent().find('.sliderFrom.min').text(timeDecode(parseInt(inputMin.val(), 10)));
				$(this).parent().find('.sliderTo.max').text(timeDecode(parseInt(inputMax.val(), 10)));
				$(this).slider('option', 'values', [parseInt(inputMin.val(), 10), parseInt(inputMax.val(), 10)]);
			}
		},
		calcRangeSlider = function (event, ui) {
			var inputMin = $(this).parents('div:first').find('input[id$="_min"]:first'),
				inputMax = $(this).parents('div:first').find('input[id$="_max"]:first'),
				elementId = $(this).attr('id'),
				labelId = elementId.substring(0, (elementId.length - 6)) + '_label';
			if (ui && ui.hasOwnProperty('value')) {
				$(this).parent().find('.sliderFrom.min').text(ui.values[0]);
				$(this).parent().find('.sliderTo.max').text(ui.values[1]);
				$('#' + labelId + ' > .min').text(ui.values[0]);
				$('#' + labelId + ' > .max').text(ui.values[1]);
				inputMin.val(ui.values[0]).trigger('change');
				inputMax.val(ui.values[1]).trigger('change');
			} else {
				$(this).parent().find('.sliderFrom.min').text(parseInt(inputMin.val(), 10));
				$(this).parent().find('.sliderTo.max').text(parseInt(inputMax.val(), 10));
				$('#' + labelId + ' > .min').text(parseInt(inputMin.val(), 10));
				$('#' + labelId + ' > .max').text(parseInt(inputMax.val(), 10));
				$(this).slider('option', 'values', [parseInt(inputMin.val(), 10), parseInt(inputMax.val(), 10)]);
			}
		};

	$('.validate').on('blur', function () {
		fieldValidationOnBlur(jQuery(this));
	});
	$('input[type="checkbox"].validate').on('change', function () {
		$(this).trigger('blur');
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
		}).find('div.ui-slider-range').html('<div class="float-label"></div>');
		calcTimeSlider.apply(element);
	});

	// RangeTimeSlider
	$('.js-rangetime-slider').each(function () {
		var element = $(this);
		element.slider({
			range:	true,
			values:	$.parseJSON(element.attr('data-values')),
			min:	parseInt(element.attr('data-min'), 10),
			max:	parseInt(element.attr('data-max'), 10),
			step:	parseInt(element.attr('data-step'), 10),
			slide:	calcRangeTimeSlider
		});
		calcRangeTimeSlider.apply(element);
	});

	// RangeSlider
	$('.js-range-slider').each(function () {
		var element = $(this);
		element.slider({
			range:	true,
			values:	$.parseJSON(element.attr('data-values')),
			min:	parseInt(element.attr('data-min'), 10),
			max:	parseInt(element.attr('data-max'), 10),
			step:	parseInt(element.attr('data-step'), 10),
			slide:	calcRangeSlider
		});
		calcRangeSlider.apply(element);
	});

});