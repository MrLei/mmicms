/*jslint unparam: true */
/*global $, document, window, request */
var CMS = {};

CMS.grid = function () {
	"use strict";
	var initGrid,
		getPages,
		initGridInputs;

	getPages = function (rowsCount, selected) {
		var i,
			html = '';
		for (i = 1; i <= rowsCount; i += 1) {
			if (selected === i) {
				selected = ' selected = ""';
			} else {
				selected = '';
			}
			html = html + '<option value="' + i + '"' + selected + '>' + i + '</option>';
		}
		return html;
	};

	initGridInputs = function () {

		$(".grid-field").change(function () {
			var id = $(this).attr('id'),
				splitedId = id.split('-'),
				formId = splitedId[0],
				type = splitedId[1],
				fieldType = splitedId[2],
				field = splitedId[3],
				identifier = splitedId[4],
				value = '',
				ctrl,
				url;

			if (fieldType === 'text' || fieldType === 'select') {
				value = $(this).val();
			} else if (fieldType === 'checkbox') {
				if ($(this).is(':checked')) {
					value = '1';
				} else {
					value = '0';
				}
			}
			ctrl = $('#' + formId + '__ctrl').val();
			url = request.baseUrl + "/" + request.lang + "/cms/grid/" + type +
				"/baseModule/" + request.module + "/baseSkin/" + request.skin;
			$.post(url, {ctrl: ctrl, identifier: identifier, field: field, value: value});
			if (fieldType === 'text') {
				$(this).replaceWith('<a href="#" id="' + $(this).attr('id') +
					'" type="text" class="grid-field-trigger">' + $(this).val() + '</a>');
				$('#hid_' + $(this).attr('id')).remove();
			}
		});

		$(".grid-field").blur(function () {
			$(this).trigger('change');
		});

		$(".grid-field").keypress(function (e) {
			if (e.keyCode === '13') {
				$(this).trigger('change');
				return false;
			}
			if (e.keyCode === '27') {
				$(this).val($(this).attr('name'));
				$(this).replaceWith('<a href="#" id="' + $(this).attr('id') +
					'" type="text" class="grid-field-trigger">' + $(this).val() + '</a>');
				return false;
			}
			return true;
		});
	};

	initGrid = function () {
		$("body").on('change', ".grid-spot", function () {
			var id = $(this).attr('id'),
				splitedId = id.split('-'),
				formId = splitedId[0],
				type = splitedId[1],
				field = splitedId[2],
				value,
				ctrl,
				url;

			if (type === 'filter') {
				value = $(this).val();
			} else if (type === 'order') {
				if ($(this).attr('class') === 'grid-spot asc') {
					value = 'DESC';
					$(this).attr('class', 'grid-spot desc');
				} else if ($(this).attr('class') === 'grid-spot') {
					value = 'ASC';
					$(this).attr('class', 'grid-spot asc');
				} else {
					value = '';
					$(this).attr('class', 'grid-spot');
				}
			}
			ctrl = $('#' + formId + '__ctrl').val();
			url = request.baseUrl + "/" + request.lang + "/cms/grid/" + type +
				"/baseModule/" + request.module + "/baseSkin/" + request.skin;
			$.post(url, {ctrl: ctrl, field: field, value: value}, function (result) {
				var rowsCount,
					selected;
				$('#' + formId + '_body').html(result);
				if (type === 'filter' && field !== 'counter') {
					rowsCount = $('#' + formId + '__counter').val();
					selected = $('#' + formId + '_filter_counter').val();
					$('#' + formId + '-filter-counter').html(getPages(rowsCount, selected));
				}
			});
		});

		// Grid fields
		$('body').on('click', 'a.grid-field-trigger', function () {
			$(this).replaceWith('<input name="' + $(this).html() + '" id="' +
				$(this).attr('id') + '" type="text" class="grid-field" value="' +
				$(this).html() + '"/>');
			document.getElementById($(this).attr('id')).focus();
			initGridInputs();
		});

		// Grid interiors
		$('body').on('mouseenter', '.grid tr', function () {
			$(this).attr('class', 'hover');
		}).on('mouseleave', '.grid tr', function () {
			$(this).attr('class', 'unhover');
		}).on('click', '.grid a.confirm', function () {
			return window.confirm($(this).attr('title') + '?');
		});

		// Nagłówek tabelki, nie jest zmieniany po sciągnięciu
		$("a.grid-spot").click(function () {
			$(this).trigger('change');
		});
		$("input.grid-spot").keydown(function (event) {
			if (event.which === 13) {
				event.preventDefault();
				$(this).trigger('change');
			}
		});
	};

	initGrid();
	initGridInputs();
};

$(document).ready(function () {
	"use strict";
	CMS.grid();
});
