<h1>{$entry->title}</h1>
<h3>{php_date('d.m.Y', php_strtotime($entry->dateAdd))}</h3>
{if $entry->lead}
	<p class="lead">{$entry->lead}</p>
{/if}
{$entry->text}
<h3>Galeria</h3>
{widget('cms', 'file', 'index', array('object' => 'news', 'objectId' => $entry->id))}
<a name="comments"></a>
{widget('cms', 'comment', 'index', array('allowGuests' => true, 'object' => 'news', 'objectId' => $entry->id))}