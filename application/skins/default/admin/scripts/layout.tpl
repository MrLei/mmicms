<!doctype html>
<html lang="{$lang}">
	<head>
		<meta charset="utf-8" />
		<title>{navigation()->title()}</title>
		<link rel="shortcut icon" type="image/x-icon" href="{$baseUrl}/default/cms/favicon.ico" />
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
					<a href="{@module=default@}" target="_blank">{#Podgląd frontu#}</a>
				</li>
				<li>
					<a href="{@module=admin&controller=index&action=password@}">{#Zmiana hasła#}</a>
				</li>
				<li>
					<a href="{@module=admin&controller=login&action=logout@}">{#Wyloguj się#}<span>{if $auth} {$auth->getUsername()}</span> ({foreach name=role $auth->getRoles() as $role}{$role}{if !$_roleLast}, {/if}{/foreach}){/if}</a>
				</li>
			</ul>
		</nav>
		<div class="breadcrumbs">
			{if $languages}
				<div class="languages">
				{foreach $languages as $language}
					<a title="{$language}" href="{@module=admin&controller=index&action=language&locale={$language}@}"><img{if $request->lang == $language} class="active"{/if} src="{$baseUrl}/default/geo/image/country/{$language}-ico-16.gif" alt="{$language}" /></a>
				{/foreach}
				</div>
			{/if}
			{navigation()->breadcrumbs()}
		</div>
		<nav id="main-menu">
			{navigation()->setRoot(4)->menu()}
		</nav>
		<div class="grid">
			<nav class="local">
				{$dpt = navigation()->getCurrentDepth()}
				{navigation()->setRoot(4)->setActiveBranchOnly()->setMinDepth($dpt)->setMaxDepth($dpt)->menu()}
			</nav>
			{messenger()}
			{content()}
			<div class="clear"></div>
		</div>
		<div id="footer">
			{$domain} &copy; {php_date('Y')}. Powered by MMi CMS
		</div>
	</body>
</html>