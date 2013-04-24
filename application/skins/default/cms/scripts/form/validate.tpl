{if !php_empty($errors)}
	<ul>
	{foreach $errors as $error}
		<li>{$error}</li>
	{/foreach}
	</ul>
{/if}