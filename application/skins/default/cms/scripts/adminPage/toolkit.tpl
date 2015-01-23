<div id="cms-page-composer-toolkit">
    <div class="template drag-section">{#Wiersz#}</div>
    <div class="template drag-placeholder">{#Kolumna#}</div>
	<hr />
	{foreach $widgets as $widget}
	<div class="template drag-widget" data-widget="module={$widget->module}&controller={$widget->controller}&action={$widget->action}&params={$widget->params}">
		{$widget->name}
	</div>
	{/foreach}
	<button class="icon-camera preview"> {#podgląd#}</button>
	<button class="icon-save save"> {#zapisz#}</button>
</div>