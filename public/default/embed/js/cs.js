var _emb = (new function () {

	this.setPath = function () {
		scripts = document.getElementsByTagName('script');
		for (var i = 0; i < scripts.length; i++) {
			var j = scripts[i].src.indexOf('default/embed/js/cs.js');
			if (j > 0) {
				this.domain = scripts[i].src.substr(0, j);
				break;
			}
		}
	}

	this.load = function(id, data) {
		this.setPath();
		var xhr;
		if (window.XMLHttpRequest) {
			xhr = new XMLHttpRequest();
		} else {
			xhr = new ActiveXObject('Microsoft.XMLHTTP');
		}
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) {
				document.write(xhr.responseText);
			}
		}
		xhr.open('POST', this.domain + 'embed/', false);
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send('id=' + id + '&domain=' + window.location.hostname + '&' + data);
	}

});