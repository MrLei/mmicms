{if $loginForm && !$auth}
	<h2 class="top-space">{#Zaloguj się#}</h2>
	{$loginForm}
{else}
	<h2 class="top-space">{#Witaj#}, <span>{$auth->getUsername()}</span>!</h2>
	<br />
	<a href="{@module=user&controller=login&action=logout@}">{#wyloguj#}</a>
{/if}
