<div class="comments">
<h1>{#Komentarze#}</h1>
{if $formName}
	{$$formName}
{else}
	{#Musisz być zalogowany, by dodawać komentarze#}.
{/if}
<div class="commentsEntries">
{foreach $comments as $entry}
	<div>
		{if $entry->title}
		<h2>{$entry->title}</h2>
		{/if}
		{if $entry->stars}
			<div class="stars-display">
				<p style="width:{$entry->stars}px"></p>
			</div>
		{/if}
		<p>
		{$entry->text}
		</p>
		<span>{#Dodano#}: {php_date('d.m.Y H:i', php_strtotime($entry->dateAdd))}, {#Autor#}: {$entry->signature}{if $entry->ip}, {#Adres IP#}: {php_substr($entry->ip, 0, php_strrpos($entry->ip, '.'))}.*{/if}</span>
	</div>
{/foreach}
</div>
</div>