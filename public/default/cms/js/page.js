
var CMSADMIN = CMSADMIN || {};

CMSADMIN.composer = function () {
	"use strict";
	
	var that = {},
			init,
			bind,
			unbind,
			toggle,
			takenSpaceInSection,
			root;
	
	init = function () {
		 root = $('.cms-page-composer');
		 return that;
	};
	that.init = init;

	bind = function () {

		root.find('.section').sortable({
			items: '> div.placeholder',
			opacity: 0.5,
			axis: 'x',
			tolerance: 'pointer',
			placeholder: 'holder',
			start: function (event, ui) {
				$('.holder').addClass(ui.item[0].className);
			}
		});

		root.sortable({
			items: '> section',
			opacity: 0.5,
			axis: 'y',
			tolerance: 'pointer',
			placeholder: 'holder section'
		});

		root.find('div.placeholder').sortable({
			items: '> section',
			opacity: 0.5,
			axis: 'y',
			tolerance: 'pointer',
			placeholder: 'holder section'
		});

		root.find('div.placeholder').resizable({
			handles: 'e',
			create: function (event, ui) {
				$(this).resizable('option', 'grid', $(this).parent().width() / 12);
			},
			resize: function (event, ui) {
				//obliczanie bieżącej szerokości
				var currentWidth = Math.round($(this).width() / ($(this).parent().width() / 12));

				//czyszczenie css po obliczeniach na podstawie rozmiaru
				$(this).parent().find('div.placeholder').removeAttr('data-current');
				$(this).parent().find('div.placeholder').removeAttr('style');
				$(this).attr('data-pool-excluded', '1');

				//przestawienie szerokości jeśli > 1 i nie przepełnia puli
				if (currentWidth > 0 && (currentWidth + takenSpaceInSection($(this).parent())) < 13) {
					$(this).removeAttr('class');
					$(this).addClass('placeholder ui-resizable span-' + currentWidth + '-of-12');
				}
				$(this).removeAttr('data-pool-excluded');
			}
		});

		root.find('> .section > div.placeholder').droppable({
			accept: '.template-section',
			greedy: true,
			tolerance: 'pointer',
			drop: function (event, ui) {
				$(this).prepend('<section class="section"></section>');
				unbind();
				bind();
			}
		});

		root.find('.section').droppable({
			accept: '.template-placeholder',
			greedy: true,
			tolerance: 'pointer',
			drop: function (event, ui) {
				var freeSpace = 12 - takenSpaceInSection($(this));
				if (freeSpace <= 0) {
					return false;
				}
				console.log(freeSpace);
				$(this).append('<div class="placeholder span-' + freeSpace + '-of-12"></div>');
				unbind();
				bind();
			}
		});

		root.find('.section, div.placeholder').on('dblclick', function () {
			$(this).remove();
			return false;
		});

		root.addClass('compose');

	};
	that.bind = bind;

	unbind = function () {
		if (!root.hasClass('compose')) {
			return;
		}
		root.removeClass('compose');
		root.find('.section, div.placeholder').off('dblclick');
		root.sortable().sortable('destroy');
		root.find('div.placeholder, .section').sortable().sortable('destroy');
		root.find('div.placeholder').resizable().resizable('destroy');
		root.find('div.placeholder, .section').droppable().droppable('destroy');
	};
	that.unbind = unbind;
	
	takenSpaceInSection = function (element) {
		var pool = 0;
		element.find('> div.placeholder').each(function () {
			if (!($(this).attr('data-pool-excluded') === '1')) {
				pool = pool + parseInt($(this).attr('class').match(/span\-([1-9]|10|11|12)\-of\-12/)[1]);
			}
		});
		return pool;
	}
	
	toggle = function () {
		if (!root.hasClass('compose')) {
			return bind();
		}
		return unbind();
	};
	that.toggle = toggle;

	return that;
};

$(document).ready(function () {

	CMSADMIN.composer = CMSADMIN.composer().init();
	
	CMSADMIN.composer.bind();

	$('.fix-button').click(function () {
		CMSADMIN.composer.toggle();
	});
	
	$('.drag').draggable({
		revert: true,
		snap: true
	});

});