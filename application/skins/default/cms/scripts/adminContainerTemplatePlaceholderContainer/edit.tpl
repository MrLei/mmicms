<div class="content-box">
	<div class="content-box-header">
		<h3>{if !$request->id}{#Ustawianie#}{else}{#Edycja#}{/if} {#placeholdera#}</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content clearfix">
		{$containerForm}
	</div>
</div>