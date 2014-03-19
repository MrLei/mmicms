{headScript()->appendFile($baseUrl . '/library/js/jquery/jquery.js')}
{headScript()->appendFile($baseUrl . '/library/js/jquery/ui.js')}
{headScript()->appendFile($baseUrl . '/default/cms/js/navigation.js')}
<div class="content-box">
	<div class="content-box-header">
		<h3>{#Struktura serwisu#}</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content tab-content clearfix">
		{if $navigation}
		<div class="list-path">
			{#Jesteś tutaj#}:
			{foreach $navigation.parents as $parent}
			<a href="{url(array('id' => $parent['id']))}">{if !$parent.label}{#Katalog główny#}{else}{$parent.label}{/if}</a>
			{/foreach}
			{if !php_isset($navigation.label)}
			{#Katalog główny#}
			{else}
			{$navigation.label}
			{/if}
			[<span>{#poziom#}: {$navigation.level}</span>]
		</div>
		{if !php_empty($navigation.children)}
		<ul class="list" id="navigation-list">
			{foreach $navigation.children as $id => $child}
			<li id="navigation-item-{$id}" class="navigation-{$child.type}">
				<div><a href="{url(array('id' => $child['id']))}">{$child.label}</a></div>
                <div>{if $child.disabled}Wyłączony{else}{if $child.visible==1}{#Widoczny#}{else}{#Ukryty#}{/if}{/if}</div>
				<a href="{@module=cms&controller=adminNavigation&action=edit&action=edit&type={$child.type}&id={$child.id}@}" class="button edit">{#edytuj#}</a>
				<a href="{@module=cms&controller=adminNavigation&action=edit&action=delete&id={$child.id}@}" class="button delete confirm" title="{#Czy na pewno usunąć pozycję menu wraz z podmenu#}?">{#usuń#}</a>
			</li>
			{/foreach}
		</ul>
		{else}
		<p class="navigation-empty">{#Brak kategorii, możesz dodać nową klikając poniższy przycisk#}:</p>
		{/if}
		<a class="button add" href="{@module=cms&controller=adminNavigation&action=edit&type=cms&parent={$navigation.id}@}">{#dodaj obiekt cms#}</a>
		<a class="button add" href="{@module=cms&controller=adminNavigation&action=edit&type=simple&parent={$navigation.id}@}">{#dodaj artykuł#}</a>
		<a class="button add" href="{@module=cms&controller=adminNavigation&action=edit&type=container&parent={$navigation.id}@}">{#dodaj stronę CMS#}</a>
		<a class="button add" href="{@module=cms&controller=adminNavigation&action=edit&type=link&parent={$navigation.id}@}">{#dodaj link#}</a>
		<a class="button add" href="{@module=cms&controller=adminNavigation&action=edit&type=folder&parent={$navigation.id}@}">{#dodaj folder#}</a>
		{else}
		{#Brak danych#}.
		{/if}
	</div>
</div>