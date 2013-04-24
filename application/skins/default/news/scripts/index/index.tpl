<h1>{#Aktualności#}</h1>
{foreach $news as $item}
<div class="post">
	<h2>
		<a href="{if $item->internal}{@module=news&controller=index&action=display&uri={$item->uri}@}{else}{$item->uri}{/if}">
			{$item->title}
		</a>
	</h2>
	<h3>
		{$item->dateAdd|dateFormat}
	</h3>
	{if $item->file}
	<a href="{if $item->internal}{@module=news&controller=index&action=display&uri={$item->uri}@}{else}{$item->uri}{/if}">
		<img src="{thumb($item->file, 'scalecrop', '160x120')}" alt="{$item->title}" />
	</a>
	{/if}
	<p>
	{if $item->lead}
		{$item->lead}
	{else}
		{$item->text}
	{/if}
	<span class="links">
		<a href="{if $item->internal}{@module=news&controller=index&action=display&uri={$item->uri}@}{else}{$item->uri}{/if}">{#czytaj więcej#}</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="{if $item->internal}{@module=news&controller=index&action=display&uri={$item->uri}@}#comments{else}{$item->uri}{/if}">{#skomentuj#}</a>
	</span>
	</p>
</div>
{/foreach}
{$paginator}