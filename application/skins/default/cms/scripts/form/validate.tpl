{if !php_empty($errors)}
	<span class="marker"></span>
	<ul>
		<span class="point"></span>
	{foreach $errors as $error}
		<li>{$error}</li>
	{/foreach}
		<span class="close"></span>
	</ul>
{/if}