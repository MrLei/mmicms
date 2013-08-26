<!DOCTYPE html>
<html>
	<head>
		{headScript()->appendFile($baseUrl . '/library/js/jquery/jquery.js')}
		{headScript()->appendFile($baseUrl . '/library/js/jquery/ui.js')}
		{headScript()->appendFile($baseUrl . '/default/file/js/uploader.js')}
		{headLink()->prependStylesheet($baseUrl . '/default/file/css/uploader.css')}
		{headLink()}
		{headScript()}
	</head>	
	<body>
		<div id="component">
			{content()}
		</div>
	</body>
</html>