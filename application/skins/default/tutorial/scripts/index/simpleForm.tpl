<h1>Witaj w przykładowym formularzu</h1>
{$testForm}
<a href="{@module=tutorial@}"><< Wróć</a>
<div style="margin-top: 30px">
	<p><h3>Aktualne wpisy:</h3>
	<p>
	{$i = 0}
	{foreach $items as $item}
	{$i++}{$i}. {$item.data}<br>
	{/foreach}
</div>