{headScript()->appendFile($baseUrl . '/library/js/jquery/jquery.js')}
{headScript()->appendFile($baseUrl . '/default/cms/js/pagewidget.js')}
<div class="content-box column-left">
	<div class="content-box column-right">
		<div class="content-box-header">
			<h3>{#Widgety dostępne dla użytkowników#}</h3>
			<div class="clear"></div>
		</div>
		<div class="content-box-content clearfix">
			<div id="widgets">
				<table class="grid striped">
					<tr>
						<th>{#Lp#}.</th>
						<th>{#nazwa#}</th>
						<th>{#wywołanie#}</th>
						<th>{#parametry#}</th>
						<th>{#aktywny#}</th>
						<th>{#operacje#}</th>
					</tr>
					{$i=1}
					{foreach $widgets as $widget}
						<tr id="widget-row-{$widget->id}">
							<td>
								{$i}{$i++}
							</td>
							<td>
								{$widget->name}
							</td>
							<td>
								{$widget->module} - {$widget->controller} - {$widget->action}
							</td>
							<td>
								{$widget->params}
							</td>
							<td>
								<input class="widget-checkbox" id="widget-{$widget->id}" type="checkbox" {if $widget->active == 1}checked=""{/if}>
							</td>
							<td>
								<a id="widget-remove-{$widget->id}" class="remove-widget confirm" title="{#Czy na pewno chcesz usunąć ten widget#}" href="#"><i class="icon-remove-circle"></i></a>
							</td>
						</tr>
					{/foreach}
				</table>
				<br /> <br />
				<h5>{#Dodaj widget#}:</h5>
				{$widgetForm}
			</div>
		</div>
	</div>
	<div class="content-box-content clearfix">
</div>