$(document).ready(function () {
	$("a.lightbox").lightBox({
		imageLoading: request.baseUrl + "/library/images/lightbox-ico-loading.gif",
		imageBtnClose: request.baseUrl + "/library/images/lightbox-btn-close.gif",
		imageBtnPrev: request.baseUrl + "/library/images/lightbox-btn-prev.gif",
		imageBtnNext: request.baseUrl + "/library/images/lightbox-btn-next.gif",
		imageBlank: request.baseUrl + "/library/images/lightbox-blank.gif",
		containerResizeSpeed: 150,
		txtImage: "Obraz",
		txtOf: "z"
	});
});