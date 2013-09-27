<h2>Aktualności</h2>
<ul>
	{foreach $news as $entry}
	<li>
		<a href="{@module=news&controller=index&action=display&uri={$entry->uri}@}">
			{escape($entry->title|truncate:45)}
		</a>
	</li>
	{/foreach}
</ul>