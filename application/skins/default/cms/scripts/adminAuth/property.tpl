{headScript()->appendFile($baseUrl . '/library/js/jquery/jquery.js')}
{headScript()->appendFile($baseUrl . '/library/js/jquery/ui.js')}
{headScript()->appendFile($baseUrl . '/default/cms/js/property.js')}
<div class="content-box">
	<div class="content-box-header">
		<h3>{#Właściwości użytkownika#}</h3>
		{navigation()->setRoot(4)->setMinDepth(3)->setMaxDepth(3)->setActiveBranchOnly()->menu()}
		<div class="clear"></div>
	</div>
	<div class="content-box-content clearfix">
		{if php_count($properties) > 0}
			<ul class="list" id="property-list">
				{foreach $properties as $property}
					<li id="property-{$property->id}">
						<div>{$property->name} ({$property->inputFormField} / {$property->searchFormField})</div>
						<a href="{url(array('action' = > 'propertyEdit', 'id' => $property->id))}" class="button edit">{#edytuj#}</a>
						<a href="{@module=cms&controller=adminAuth&action=propertyDelete&id={$property->id}@}" class="button delete confirm" title="{#Czy na pewno usunąć pozycję menu wraz z podmenu#}?">{#usuń#}</a>
					</li>
				{/foreach}
			</ul>
		{else}
			<p>{#Nie wprowadzono właściwości użytkownika#}.</p>
		{/if}
	</div>
</div>