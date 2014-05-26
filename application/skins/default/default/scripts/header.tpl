<!doctype html>
<html lang="{$request->lang}">
	<head>
		<title>{navigation()->title()}</title>
		<link rel="shortcut icon" type="image/x-icon" href="{$baseUrl}/favicon.ico" />
		{headLink()->appendStyleSheet($baseUrl . '/default/default/style.css')}
		{headLink()}
		{headScript()}
		<meta charset="utf-8" />
		<meta name="description" content="{navigation()->description()}" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<!--[if lte IE 8]><script type="text/javascript" src="{$baseUrl}/library/js/html5.js"></script><![endif]-->
	</head>
	<body>
		<div class="line"></div>
		<header id="masterhead" class="top-level">
			<a href="{@module=default@}"><h2><strong>Demo</strong>CMS</h2></a>
			<div class="cl"></div>
			<nav class="breadcrumbs">
				{navigation()->breadcrumbs()}
			</nav>
			<nav class="top-level">
				{navigation()->setRoot(1)->menu()}
			</nav>
		</header>
		{messenger()}