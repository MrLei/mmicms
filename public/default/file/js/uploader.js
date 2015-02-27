$(document).ready(function () {

	function bindSortable() {

		$("#manageImage").sortable({
			axis: 'x',
			cancel: '#manageImage > li > img',
			update: function(event, ui) {
				$.post(
					request.baseUrl + "/cms/admin-file/sort/order/",  $(this).sortable('serialize'),
					function(result) {
						if (result) {
							alert(result);
						}
					});
			}
		});

		$('#manageOther').sortable({
			axis: 'x',
			update : function(event, ui) {
				$.post(
					request.baseUrl + "/cms/admin-file/sort/order/", $(this).sortable('serialize'),
					function(result) {
						if (result) {
							alert(result);
						}
					});
			}
		});

	}

	$('body').on('click', 'a.edit-file', function () {
		var id = $(this).attr('id').split('-');
		$('li').removeClass('editActive');
		$('#item-file-' + id[2]).addClass('editActive');
		$.getJSON(
			request.baseUrl + '/cms/admin-file/edit/id/' + id[2] + '/hash/' + id[3],
			function(result) {
				if (result.error != undefined) {
					alert(result.error);
					return false;
				}
				$('#fileUpload').hide();
				$('#uploaderEdit').show();
				$('#uploaderEditForm').attr('action', request.baseUrl + '/cms/admin-file/edit/id/' + id[2] + '/hash/' + id[3]);
				$('#editTitle').val(result.title);
				$('#editAuthor').val(result.author);
				$('#editSource').val(result.source);
				$('#editDescription').val(result.description);
			});
		return false;
	});

	$('body').on('click', 'a.remove-file', function () {
		if (!window.confirm($(this).attr('title') + '?')) {
			return false;
		}
		var id = $(this).attr('id').split('-');
		$.get(
			request.baseUrl + '/cms/admin-file/delete/id/' + id[1] + '/hash/' + id[2],
			function(result) {
				if (!result) {
					location.reload(); 
					//$('#item-file-' + id[1]).remove();
				} else {
					alert(result);
				}
			});
		return false;
	});

	$('body').on('click', 'input#editReset', function () {
		$('li').removeClass('editActive');
		$('#uploaderEdit').hide();
		$('#fileUpload').show();
		$('#uploaderEditForm').attr('action', '');
		return true;
	});

	$('body').on('click', 'input#editSubmit', function () {
		$.post(
			$('#uploaderEditForm').attr('action'),
			$('#uploaderEditForm').serialize(),
			function(result) {
				if (!result) {
					$('li').removeClass('editActive');
					$('#uploaderEdit').hide();
					$('#fileUpload').show();
					$('#uploaderEditForm').attr('action', '');
				} else {
					alert(result);
				}
			});
		return false;
	});

	$('body').on('click', 'input.sticky', function () {
		var id = $(this).attr('id').split('-');
		$.get(
			request.baseUrl + '/cms/admin-file/stick/id/' + id[2] + '/hash/' + id[3],
			function(result) {
				if (result) {
					alert(result);
				}
			});
	});

	function fileUpload() {
		form = document.getElementById('uploader');
		// Create the iframe...
		var iframe = document.createElement("iframe");
		iframe.setAttribute("id", "upload_iframe");
		iframe.setAttribute("name", "upload_iframe");
		iframe.setAttribute("width", "0");
		iframe.setAttribute("height", "0");
		iframe.setAttribute("border", "0");
		iframe.setAttribute("style", "width: 0; height: 0; border: none;");

		// Add to document...
		form.parentNode.appendChild(iframe);
		window.frames['upload_iframe'].name = "upload_iframe";

		iframeId = document.getElementById("upload_iframe");

		// Add event...
		var eventHandler = function () {

			if (iframeId.detachEvent) iframeId.detachEvent("onload", eventHandler);
			else iframeId.removeEventListener("load", eventHandler, false);

			// Message from server...
			if (iframeId.contentDocument) {
				content = iframeId.contentDocument.body.innerHTML;
			} else if (iframeId.contentWindow) {
				content = iframeId.contentWindow.document.body.innerHTML;
			} else if (iframeId.document) {
				content = iframeId.document.body.innerHTML;
			}

			document.getElementById('component').innerHTML = content;
			bindSortable();

			// Del the iframe...
			setTimeout('iframeId.parentNode.removeChild(iframeId)', 500);
		}

		if (iframeId.addEventListener) iframeId.addEventListener("load", eventHandler, true);
		if (iframeId.attachEvent) iframeId.attachEvent("onload", eventHandler);

		// Set properties of form...
		form.setAttribute("target", "upload_iframe");
		form.setAttribute("method", "post");
		form.setAttribute("enctype", "multipart/form-data");
		form.setAttribute("encoding", "multipart/form-data");

		// Submit the form...
		//document.forms[0].action = action_url;
		document.forms[0].submit();
		document.getElementById('manageOther').innerHTML = '<li class="item">Upload...</li>';
	}

	$('body').on('change', 'input#file', function () {
		fileUpload();
		$('input#file').val('');
	});

	bindSortable();

});