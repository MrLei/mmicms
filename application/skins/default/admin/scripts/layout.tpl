<!doctype html>
<html lang="{$lang}">
	<head>
		<meta charset="utf-8" />
		<title>{navigation()->title()}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		{headLink()->appendStyleSheet($baseUrl . '/default/cms/css/kickstart.css')}
		{headLink()->appendStyleSheet($baseUrl . '/default/cms/css/style.css')}
		{headLink()}
		{headScript()->appendFile($baseUrl . '/library/js/jquery/jquery.js')}
		{headScript()->appendFile($baseUrl . '/default/cms/js/kickstart.js')}
		{headScript()}
	</head>
	<body>
		<nav class="navbar">
			<ul>
				<li>
					<a href="{@module=admin@}"><span>{$domain|replace:'www.':''}</span></a>
				</li>
				<li>
					<a href="{@module=admin&controller=index&action=password@}">{#Zmiana hasła#}</a>
				</li>
				<li>
					<a href="{@module=admin&controller=login&action=logout@}">{#Wyloguj się#}</a>
				</li>
			</ul>
		</nav>
		<div class="breadcrumbs">
			{navigation()->breadcrumbs()}
		</div>
		<nav id="main-menu">
			{navigation()->setRoot(4)->menu()}
		</nav>
		<div class="grid">
			{messenger()}
			{content()}
		</div>
		<div id="footer">
			<small>{$domain} &copy; {php_date('Y')}. Powered by MMi CMS</small>
		</div>
	</body>
</html>