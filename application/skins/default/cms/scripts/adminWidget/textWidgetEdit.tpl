<div class="content-box">
	<div class="content-box-header">
		<h3>{#Treści widgetu Text#}</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content clearfix">
		{$grid}
	</div>
                {if $request->id}Edytujesz zawartość o ID = {$textId}{/if}
	<div class="content-box-content clearfix">
		{$textForm}
	</div>
</div>