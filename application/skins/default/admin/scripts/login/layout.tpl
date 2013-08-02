<!doctype html>
<html lang="{$lang}">
	<head>
		<meta charset="utf-8" />
		<title>{navigation()->title()}</title>
		{headLink()->appendStyleSheet($baseUrl . '/default/cms/style.css')}
		{headLink()}
		{headScript()}
	</head>
	<body>
		<div id="body-wrapper">
			<div id="sidebar">
				<div id="sidebar-wrapper">
					<h1><a href="{@module=admin@}">{$domain|replace:'www.':''}</a></h1>
				</div>
			</div>

			<div id="main-content">
				<h1>{#Strona dostępna wyłącznie dla uprawnionych użytkowników#}</h1>
				<h3>{#Wprowadź swój login i hasło#}</h3><br /><br />
				{messenger()}
				{content()}
				<div id="footer">
					<small>{php_ucfirst($domain)} &copy; {php_date('Y')}. Powered by MMi CMS</small>
				</div>
			</div>

		</div>
	</body>
</html>