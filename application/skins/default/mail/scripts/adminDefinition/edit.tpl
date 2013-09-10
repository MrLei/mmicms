<div class="content-box">
	<div class="content-box-header">
		<h3>{if $definitionForm->getRecord()->id > 0}{#Edycja#}{else}{#Dodawanie#}{/if} {#definicji maila#}</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
		{$definitionForm}
	</div>
</div>