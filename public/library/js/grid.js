$(document).ready(function () {
	initGrid();
	initGridInterior();
	initGridFields();
	initGridInputs();
	
});

function initGrid() {

	$(".grid-spot").live('change', function () {
		var id = $(this).attr('id');
		var splitedId = id.split('-');
		var formId = splitedId[0];
		var type = splitedId[1];
		var field = splitedId[2];
		if (type == 'filter') {
			var value = $(this).val();
		} else
		if (type == 'order') {
			var value;
			if ($(this).attr('class') == 'grid-spot asc') {
				value = 'DESC';
				$(this).attr('class', 'grid-spot desc');
			} else if ($(this).attr('class') == 'grid-spot') {
				value = 'ASC';
				$(this).attr('class', 'grid-spot asc');
			} else {
				value = '';
				$(this).attr('class', 'grid-spot');
			}
		}
		var ctrl = $('#' + formId + '__ctrl').val();
		$.post(request.baseUrl + "/" + request.lang + "/cms/grid/" + type + "/baseModule/" + request.module + "/baseSkin/" + request.skin,
		{
			'ctrl': ctrl,
			'field': field,
			'value': value
		},
		function (result)
		{
			$('#' + formId + '_body').html(result);
			if (type == 'filter' && field != 'counter')
			{
				var rowsCount = $('#' + formId + '__counter').val();
				var selected = $('#' + formId + '_filter_counter').val();
				$('#' + formId + '-filter-counter').html(getPages(rowsCount, selected));
			}
			initGridFields();
			initGridInterior();
		});
	});
		
	$("a.grid-spot").click(function () {
		$(this).trigger('change');
	});

	$("input.grid-spot").keypress(function (e) {
		if (e.which == '13') {
			$(this).trigger('change');
			return false;
		}
		return true;
	});
}

function initGridInterior() {
	$(".grid tr").mouseover(function () {
		$(this).attr('class', 'hover');
	});

	$(".grid tr").mouseout(function () {
		$(this).attr('class', 'unhover');
	});

	$('a.confirm').click(function () {
		return window.confirm($(this).attr('title') + '?');
	});
}

function initGridFields() {
	$("a.grid-field-trigger").click(function () {
		$(this).replaceWith('<input name="' + $(this).html() + '" id="' + $(this).attr('id') + '" type="text" class="grid-field" value="' + $(this).html() + '"/>');
		document.getElementById($(this).attr('id')).focus();
		initGridInputs();
	});
}

function initGridInputs()
{
	$(".grid-field").change(function () {
		var id = $(this).attr('id');
		var splitedId = id.split('-');
		var formId = splitedId[0];
		var type = splitedId[1];
		var fieldType = splitedId[2];
		var field = splitedId[3];
		var identifier = splitedId[4];
		var value = '';
		if (fieldType == 'text' || fieldType == 'select')
		{
			value = $(this).val();
		} else if (fieldType == 'checkbox') {
			if ($(this).attr('checked')) {
				value = '1';
			} else {
				value = '0';
			}
		}
		var ctrl = $('#' + formId + '__ctrl').val();
		$.post(
			request.baseUrl + "/" + request.lang + "/cms/grid/" + type + "/baseModule/" + request.module + "/baseSkin/" + request.skin,
			{
				'ctrl': ctrl,
				'identifier': identifier,
				'field': field,
				'value': value
			}
			);
		if (fieldType == 'text')
		{
			$(this).replaceWith('<a href="#" id="' + $(this).attr('id') + '" type="text" class="grid-field-trigger">' + $(this).val() + '</a>');
			$('#hid_' + $(this).attr('id')).remove();
		}
		initGridFields();
	});

	$(".grid-field").blur(function () {
		$(this).trigger('change');
	});

	$(".grid-field").keypress(function (e) {
		if (e.keyCode == '13') {
			$(this).trigger('change');
			return false;
		}
		if (e.keyCode == '27') {
			$(this).val($(this).attr('name'));
			$(this).replaceWith('<a href="#" id="' + $(this).attr('id') + '" type="text" class="grid-field-trigger">' + $(this).val() + '</a>');
			initGridFields();
			return false;
		} else {}
		return true;
	});
}

function getPages(rowsCount, selected) {
	var html = '';
	for (i=1; i<=rowsCount; i = i + 1) {
		if (selected == i) {
			selected = ' selected = ""';
		} else {
			selected = '';
		}
		html = html + '<option value="' + i + '"' + selected + '>' + i + '</option>';
	}
	return html;
}