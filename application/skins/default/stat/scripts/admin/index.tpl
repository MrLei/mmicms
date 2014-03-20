{headScript()->appendFile($baseUrl . '/library/js/jquery/jquery.js')}
{headScript()->appendFile($baseUrl . '/default/stat/js/flot.js')}
{headScript()->appendFile($baseUrl . '/default/stat/js/tooltip.js')}
{headLink()->appendStylesheet($baseUrl . '/default/stat/admin.css')}
<script type="text/javascript">
	{$dailyChart}
	{$monthlyChart}
	{$yearlyChart}
	{$avgHourlyChart}
	{$avgHourlyAllChart}
</script>
<div class="content-box">
	<div class="content-box-header">
		<h3 class="charts">{if $label}{$label->label}{else}{#Statystyki#}{/if}{if $label}{/if}</h3>
		{if $label}<p>{$label->description}</p>{/if}
		<div class="clear"></div>
	</div>
	<div class="content-box-content clearfix">
		{$objectForm}
		<div class="clear"></div>
		{if !$label}
			<p>{#Ustaw parametry by przeglądać statystyki#}...</p>
		{/if}
	</div>
</div>

<div class="content-box">
	<div class="content-box-header">
		<h3>{#Statystyki dzienne#}</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content clearfix">
		<div id="dailyChart" class="chart"></div>
	</div>
</div>

<div class="content-box">
	<div class="content-box-header">
		<h3>{#Statystyki miesięczne#} / {#roczne#}</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content clearfix">
		<div id="monthlyChart" class="chart"></div>
		<div id="yearlyChart" class="chart"></div>
	</div>
</div>

<div class="content-box">
	<div class="content-box-header">
		<h3>{#Rozkład godzinowy bieżący miesiąc#} / {#rozkład godzinowy od początku#}</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content clearfix">
		<div id="avgHourlyChart" class="chart"></div>
		<div id="avgHourlyAllChart" class="chart"></div>
	</div>
</div>
