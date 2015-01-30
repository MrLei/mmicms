<div class="cms-page-composer-toolkit">
    <div class="template drag-section">{#Wiersz#}</div>
    <div class="template drag-placeholder">{#Kolumna#}</div>
	<hr />
	{foreach $widgets as $widget}
	<div class="template drag-widget" data-widget="'{$widget->module}', '{$widget->controller}', '{$widget->action}', array({$widget->params}">
		{$widget->name}
	</div>
	{/foreach}
	<button class="icon-camera preview"> {#podgląd#}</button>
	<button class="icon-save save"> {#zapisz#}</button>
</div>
<div class="cms-page-composer-compilation"></div>