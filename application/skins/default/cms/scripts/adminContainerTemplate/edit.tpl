{if $request->id}
	{widget('cms', 'adminContainerTemplatePlaceholder', 'index', array('templateId' => $request->id))}
{/if}
<div class="content-box">
	<div class="content-box-header">
		<h3>{if !$request->id}{#Dodawanie#}{else}{#Edycja#}{/if} {#szablonu#}</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content clearfix">
		{$templateForm}
	</div>
</div>