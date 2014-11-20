<h1>{#Ekspresowe zasilenia#}</h1>
{if $payments}
	{foreach $payments as $payment}
		<div class="offer">
			<div style="float: right;">
				{if $payment->status == 0 || $payment->status == 2}
					<a class="button" href="{@module=payment&controller=index&action=pay&id={$payment->id}&regenerate=1@}">{#zapłać#}{if $payment->status} {#ponownie#}{/if}</a>
				{/if}
			</div>
			<h2>{if $payment->status == 0 || $payment->status == 1}<span class="inactive">[{if $payment->status == 1}{#czeka na weryfikację#}{else}{#nowa#}{/if}]</span>{elseif $payment->status == 2}<span class="fail">[{#anulowana#}]</span>{elseif $payment->status >= 3}<span class="active">[{#zaakceptowana#}]</span>{/if}{#Płatność nr#}: #{$payment->id}</h2>
			{#Opis płatności#}: <span>{$payment->text}</span><br />
			{#Kwota#}: <span>{$payment->value|numberFormat} {#zł#}</span><br />
			{#Data zamówienia#}: <span>{$payment->dateAdd}</span>
			<div class="cl"></div>
		</div>
	{/foreach}
	{$paginator}
{else}
	{#Nie dokonałeś jeszcze żadnych zakupów#}...
{/if}