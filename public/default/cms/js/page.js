var CMSADMIN = CMSADMIN || {};

CMSADMIN.composer = function () {
	"use strict";

	var that = {},
			init,
			bind,
			unbind,
			toggle,
			save,
			takenSpaceInSection,
			composerRoot,
			toolkitRoot,
			compilationRoot,
			saveEndpoint;

	init = function () {
		composerRoot = $('.cms-page-composer');
		toolkitRoot = $('.cms-page-composer-toolkit');
		compilationRoot = $('.cms-page-composer-compilation');
		saveEndpoint = request.baseUrl + '/cms/adminPage/update';

		toolkitRoot.find('.template').draggable({
			revert: true,
			snap: false
		});

		toolkitRoot.find('.preview').click(function () {
			toggle();
		});

		toolkitRoot.find('.save').click(function () {
			save();
		});

		bind();

		return that;
	};
	that.init = init;

	bind = function () {

		composerRoot.find('.section').sortable({
			items: '> .placeholder',
			opacity: 0.5,
			axis: 'x',
			tolerance: 'pointer',
			placeholder: 'holder',
			start: function (event, ui) {
				$('.holder').addClass(ui.item[0].className);
			}
		});

		composerRoot.find('.placeholder').addBack().sortable({
			items: '> section',
			opacity: 0.5,
			axis: 'y',
			tolerance: 'pointer',
			placeholder: 'holder section'
		});

		composerRoot.find('.placeholder').resizable({
			handles: 'e',
			create: function (event, ui) {
				$(this).resizable('option', 'grid', $(this).parent().width() / 12);
			},
			resize: function (event, ui) {
				//obliczanie bieżącej szerokości
				var currentWidth = Math.round($(this).width() / ($(this).parent().width() / 12));

				//czyszczenie css po obliczeniach na podstawie rozmiaru
				$(this).parent().find('.placeholder').removeAttr('data-current');
				$(this).parent().find('.placeholder').removeAttr('style');
				$(this).attr('data-pool-excluded', '1');

				//przestawienie szerokości jeśli > 1 i nie przepełnia puli
				if (currentWidth > 0 && (currentWidth + takenSpaceInSection($(this).parent())) < 13) {
					$(this).removeAttr('class');
					$(this).addClass('placeholder ui-resizable span-' + currentWidth + '-of-12');
				}
				$(this).removeAttr('data-pool-excluded');
			}
		});

		composerRoot.find('> .section > .placeholder, > .section > .placeholder > .section > .placeholder').addBack().droppable({
			accept: '.template.drag-section, .template.drag-widget',
			greedy: true,
			tolerance: 'pointer',
			drop: function (event, ui) {
				//jeśli upuszczamy widget w placeholder i w placeholderze brak sekcji
				if ($(this).hasClass('placeholder') && ui.draggable.hasClass('drag-widget') && $(this).find('> .section').size() === 0 && $(this).find('> .widget').size() === 0) {
					$(this).append('<div class="widget" data-widget="' + ui.draggable.attr('data-widget') + '">' + ui.draggable.html() + '</section>');
				}
				if (ui.draggable.hasClass('drag-section') && $(this).find('> .widget').size() === 0 && ($(this).parent().parent().hasClass('compose') || $(this).hasClass('compose'))) {
					$(this).append('<section class="section"></section>');
				}
				unbind();
				bind();
			}
		});

		composerRoot.find('.section').droppable({
			accept: '.template.drag-placeholder',
			greedy: true,
			tolerance: 'pointer',
			drop: function (event, ui) {
				var freeSpace = 12 - takenSpaceInSection($(this));
				if (freeSpace <= 0) {
					return false;
				}
				$(this).append('<div class="placeholder span-' + freeSpace + '-of-12"></div>');
				unbind();
				bind();
			}
		});

		composerRoot.find('.section, .placeholder, .widget').on('dblclick', function () {
			$(this).remove();
			return false;
		});

		composerRoot.addClass('compose');

	};
	that.bind = bind;

	unbind = function () {
		if (!composerRoot.hasClass('compose')) {
			return;
		}
		composerRoot.removeClass('compose');
		composerRoot.find('.section, .placeholder, .widget').off('dblclick');
		composerRoot.find('.placeholder, .section').addBack().sortable().sortable('destroy');
		composerRoot.find('.placeholder').resizable().resizable('destroy');
		composerRoot.find('.placeholder, .section').addBack().droppable().droppable('destroy');
	};
	that.unbind = unbind;

	toggle = function () {
		if (!composerRoot.hasClass('compose')) {
			return bind();
		}
		return unbind();
	};
	that.toggle = toggle;

	save = function () {
		unbind();
		compilationRoot.html(composerRoot.html());
		compilationRoot.find('.placeholder').each(function () {
			if ($(this).find('.widget').attr('data-widget') !== undefined) {
				$(this).html('{widget(' + $(this).find('.widget').attr('data-widget') + ')}');
			}
		});
		$.ajax({
			type: 'POST',
			url: saveEndpoint,
			data: {id: request.id, data: compilationRoot.html()}
		}).done(function () {
			bind();
		});
	};

	takenSpaceInSection = function (element) {
		var pool = 0;
		element.find('> .placeholder').each(function () {
			if (!($(this).attr('data-pool-excluded') === '1')) {
				pool = pool + parseInt($(this).attr('class').match(/span\-([1-9]|10|11|12)\-of\-12/)[1]);
			}
		});
		return pool;
	};

	return that;
};

$(document).ready(function () {

	CMSADMIN.composer = CMSADMIN.composer().init();

});