<div class="content-box">
	<div class="content-box-header">
		<h3>{if $configForm->getRecord()->id > 0}{#Edycja#}{else}{#Dodawanie#}{/if} {#punktu płatności#}</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
		{$configForm}
	</div>
</div>