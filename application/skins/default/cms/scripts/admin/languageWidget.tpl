{if $languages}
	<div class="languages">
		<a{if !$request->lang} class="active"{/if} href="{@module=cms&controller=admin&action=language&locale=null@}"{#>wszystkie#}</a>
		{foreach $languages as $language}
			<a{if $request->lang == $language} class="active"{/if} title="{$language}" href="{@module=cms&controller=admin&action=language&locale={$language}@}"><img src="{$baseUrl}/default/geo/image/country/{$language}-ico-16.gif" alt="{$language}" /></a>
			{/foreach}
	</div>
{/if}