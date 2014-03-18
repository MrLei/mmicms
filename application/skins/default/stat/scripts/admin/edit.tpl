<div class="content-box">
	<div class="content-box-header">
		<h3>{if $labelForm->getRecord()->id > 0}{#Edycja statystyki#} {$labelForm->getRecord()->label}{else}{#Dodawanie statystyki#}{/if}</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content tab-content clearfix">
		{$labelForm}
	</div>
</div>
