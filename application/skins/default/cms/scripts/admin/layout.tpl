<!doctype html>
<html{* lang="{$lang}"*}>
	<head>
		<meta charset="utf-8" />
		<title>{navigation()->title()}</title>
		<link rel="shortcut icon" type="image/x-icon" href="{$baseUrl}/default/cms/favicon.ico" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		{headLink()->appendStyleSheet($baseUrl . '/default/cms/css/kickstart.css')}
		{headLink()->appendStyleSheet($baseUrl . '/default/cms/css/style.css')}
		{headLink()}
		{headScript()->prependFile($baseUrl . '/default/cms/js/jquery/jquery.js')}
		{headScript()->appendFile($baseUrl . '/default/cms/js/kickstart.js')}
		{headScript()->appendFile($baseUrl . '/default/cms/js/form.js')}
		{headScript()}
	</head>
	<body>
		<nav class="navbar">
			<ul>
				<li>
					<a href="{@module=cms&controller=index&action=index@}"><span>{$domain|replace:'www.':''}</span></a>
				</li>
				<li>
					<a href="{@module=core@}" target="_blank">{#Podgląd frontu#}</a>
				</li>
				{if $auth && $acl->isAllowed($auth->getRoles(), 'cms:admin:password')}
				<li>
					<a href="{@module=cms&controller=admin&action=password@}">{#Zmiana hasła#}</a>
				</li>
				<li>
					<a href="{@module=cms&controller=admin&action=logout@}">{#Wyloguj się#}<span>{if $auth} {$auth->getUsername()}</span> ({foreach name=role $auth->getRoles() as $role}{$role}{if !$_roleLast}, {/if}{/foreach}){/if}</a>
				</li>
				{/if}
			</ul>
		</nav>
		{if $auth}
		<div class="breadcrumbs">
			{navigation()->breadcrumbs()}
			{widget('cms', 'admin', 'languageWidget')}
		</div>
		{/if}
		<nav id="main-menu">
			{navigation()->setRoot(1000000)->menu()}
		</nav>
		<div class="grid">
			{messenger()}
			<nav class="local">
				{$currentDepth = navigation()->getCurrentDepth()}
				{navigation()->setRoot(1000000)->setActiveBranchOnly()->setMinDepth($currentDepth)->setMaxDepth($currentDepth)->menu()}
			</nav>
			{content()}
		</div>
		<div id="footer">
			{$domain} &copy; {system_date('Y')}. Powered by MMi CMS
		</div>
	</body>
</html>