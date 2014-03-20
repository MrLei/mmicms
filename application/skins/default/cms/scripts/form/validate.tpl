{if !php_empty($errors)}
<div>
	<span class="marker"></span>
	<ul>
		<li class="point"></li>
	{foreach $errors as $error}
		<li>{$error}</li>
	{/foreach}
		<li class="close"></li>
	</ul>
</div>
{/if}