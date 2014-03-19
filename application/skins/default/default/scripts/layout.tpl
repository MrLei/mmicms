<!doctype html>
<html lang="{$request->lang}">
	<head>
		<title>{$title}</title>
		<link rel="shortcut icon" type="image/x-icon" href="{$baseUrl}/favicon.ico" />
		{headLink()->appendStyleSheet($baseUrl . '/default/default/style.css')}
		{headLink()}
		{headScript()}
		<meta charset="utf-8" />
		<meta name="description" content="{$description}" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<!--[if lte IE 8]><script type="text/javascript" src="{$baseUrl}/color/default/js/html5.js"></script><![endif]-->
	</head>
	<body>
		<div class="line"></div>
		<header id="masterhead" class="top-level">
			<a href="{@module=default@}"><h2><strong>Demo</strong>CMS</h2></a>
			<div class="cl"></div>
			<h1>{navigation()->title()}</h1>
			<nav class="top-level">
				{navigation()->setRoot(101)->menu()}
			</nav>
		</header>
		<article role="main" class="top-level">
			{messenger()}
			{content()}
		</article>
		<footer class="top-level">
			&copy; 2011-{php_date('Y')} Powered by MMi CMS
		</footer>
	</body>
</html>