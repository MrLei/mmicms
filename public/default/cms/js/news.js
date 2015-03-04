$(document).ready(function () {

	function toggleInternal() {
		if (!$('#news_internal').is(':checked')) {
			$('#news_uri_container').show();
			$('#news_text_container').hide();
			$('#news_lead_container').hide();
		} else {
			$('#news_uri_container').hide();
			$('#news_text_container').show();
			$('#news_lead_container').show();
		}
	}
	
	toggleInternal();

	$('#news_internal').change(function () {
		console.log($('#news_internal').attr('checked'));
		toggleInternal();
	});
	
});