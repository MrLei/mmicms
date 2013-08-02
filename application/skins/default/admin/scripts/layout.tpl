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
					<div id="profile-links">
						{#Zalogowany#}: {$loggedUsername} ({$loggedRoles})
						<br />
						<a href="{@module=admin&controller=index&action=password@}">{#Zmiana hasła#}</a> | <a href="{@module=admin&controller=login&action=logout@}">{#Wyloguj się#}</a>
					</div>
					{navigation()->setRoot(4)->setMaxDepth(1)->setActiveBranchOnly()->menu()}
				</div>
			</div>
			<div id="main-content">
				<div class="breadcrumbs">
					{navigation()->breadcrumbs()}
				</div>
				<div class="shortcuts">
				{navigation()->setRoot(4)->setMinDepth(2)->setMaxDepth(2)->setActiveBranchOnly()->menu()}
				<div class="clear"></div>
				</div>
				{messenger()}
				{content()}
				<div id="footer">
					<small>{$domain} &copy; {php_date('Y')}. Powered by MMi CMS</small>
				</div>
			</div>
		</div>
	</body>
</html>