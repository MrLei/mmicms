{if ($loginForm)}
	{$loginForm}
{else}
	<a href="{url(array('controller' =>'login', 'action' => 'logout'), 'pl', true)}">logout</a>
{/if}