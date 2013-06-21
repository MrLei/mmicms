{if $loginForm && !$auth}
	{$loginForm}
{else}
<h2>{#Witaj#}, <span>{$auth->username}</span>!</h2>
<a href="{@module=user&controller=login&action=logout@}">{#wyloguj#}</a>
{/if}
