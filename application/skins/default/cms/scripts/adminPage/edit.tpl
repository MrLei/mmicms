<div class="content-box">
	<div class="content-box-header">
		<h3>{if !$request->id}{#Dodawanie#}{else}{#Edycja#}{/if} {#strony CMS#}</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content clearfix">
		{$editForm}
	</div>
</div>