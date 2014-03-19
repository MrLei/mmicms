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
		<h3 class="charts">{if $label}{$label->label} - {#statystyki#}{else}{#Statystyki#}{/if}{if $label} ({$label->description}){/if}</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content clearfix">
		{$objectForm}
		<div class="clear"></div>
		{if $label}
		<h4>{#Statystyki dzienne#}</h4>
		<div id="dailyChart" class="chart"></div>
		<h4>{#Statystyki miesięczne#} / {#roczne#}</h4>
		<div id="monthlyChart" class="chart"></div>
		<div id="yearlyChart" class="chart"></div>
		<div class="clear"></div>
		<h4>{#Rozkład godzinowy bieżący miesiąc#} / {#rozkład godzinowy od początku#}</h4>
		<div id="avgHourlyChart" class="chart"></div>
		<div id="avgHourlyAllChart" class="chart"></div>
		<div class="clear"></div>
		{else}
		<h3>{#Określ parametry statystyki powyżej#}...</h3>
		{/if}
	</div>
</div>