<div class="content-box">
	<div class="content-box-header">
		<h3>{#Placeholdery w szablonie#}</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content clearfix">
		{$grid}
		<br />
		<a class="button" href="{@module=cms&controller=adminContainerTemplatePlaceholder&action=edit&templateId={$request->templateId}@}">dodaj placeholder</a>
	</div>
</div>
