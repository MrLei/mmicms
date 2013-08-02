<div class="content-box">
	<div class="content-box-header">
		<h3>{#Dekoduj ślad#}</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
		{$traceForm}
	</div>
</div>
{if $trace}
	<div class="content-box">
		<div class="content-box-header">
			<h3>{#Zdekodowany ślad#}</h3>
			<div class="clear"></div>
		</div>
		<div class="content-box-content">
			<strong>{$trace.message}</strong>
			<br />{$trace.file}<br /><br />
			<pre>{php_nl2br($trace.info)}</pre>
		</div>
	</div>

{/if}