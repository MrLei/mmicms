<div class="content-box">
	<div class="content-box-header">
		<h3>{if $serverForm->getRecord()->id > 0}{#Edycja#}{else}{#Dodawanie#}{/if} {#konfiguracji serwera#}</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content tab-content clearfix">
		{$serverForm}
	</div>
</div>