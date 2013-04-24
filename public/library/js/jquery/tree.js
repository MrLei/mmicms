jQuery.fn.empty = function() {
	return this.each( function() {
		while ( this.firstChild )
			this.removeChild( this.firstChild );
	}, arguments );
};

jQuery(document).ready(initArticleTree);

var submenuList = false;

function initArticleTree() {
	$('#tree').NestedSortable(
		{
		accept: 'tree-item',
		opacity: 0.6,
		helperclass: 'helper',
		onChange: function(serialized) {
			$('input#treeChanged').val(serialized[0].hash);
		},
		autoScroll: true,
		nestingPxSpace: '15',
		handle: '.sort-handle'
		}
	);

	submenuList = $('.tree-submenu');
	$('.tree-toggle').click(toggleSubmenu);
}

function toggleSubmenu() {

	var id = this.id.substr(14);

	var menu = $('#articleSub-' + id);

	menu.toggle();

	if (!submenuList) return;

	var expanded = [];
	submenuList.each(function() {
		if (!$(this).is(":hidden")) {
			expanded.push(this.id.substr(11));
		}
	});

	$.cookie('artExpand', expanded.join(','));
}