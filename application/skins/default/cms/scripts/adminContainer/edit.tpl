{if $request->id}
	{widget('cms', 'adminContainerTemplatePlaceholderContainer', 'index', array('containerId' => $request->id))}
{/if}
<div class="content-box">
	<div class="content-box-header">
		<h3>{#Dodawanie / edycja strony CMS#}</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content clearfix">
		{$containerForm}
	</div>
</div>