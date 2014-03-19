<h1>{#Aktualności#}</h1>
{foreach $news as $item}
<div class="post">
	{if $item->file}
	<a href="{if $item->internal}{@module=news&controller=index&action=display&uri={$item->uri}@}{else}{$item->uri}{/if}">
		<img src="{thumb($item->file, 'scalecrop', '160x120')}" alt="{$item->title}" />
	</a>
	{/if}
	<h3>
		<a href="{if $item->internal}{@module=news&controller=index&action=display&uri={$item->uri}@}{else}{$item->uri}{/if}">
			{$item->title}
		</a>
	</h3>
	<h4>
		{$item->dateAdd|dateFormat}
	</h4>
	{if $item->lead}
		{$item->lead}
	{else}
		{$item->text}
	{/if}
</div>
{/foreach}
{$paginator}