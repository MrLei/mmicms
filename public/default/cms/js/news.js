$(document).ready(function () {

	function toggleInternal() {
		if ($('#edit_internal').attr('checked') != 'checked') {
			$('#edit_uri_container').removeClass('hidden');
			$('#edit_uri_container').addClass('text');
			$('#edit_text_container').hide();
		} else {
			$('#edit_uri_container').removeClass('text');
			$('#edit_uri_container').addClass('hidden');
			$('#edit_text_container').show();
		}
	}
	
	toggleInternal();

	$('#edit_internal').change(function () {
		toggleInternal();
	});
	
});