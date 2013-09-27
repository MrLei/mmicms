<h1>{#Transakcja została odrzucona#}</h1>
<p>
	{#Operator płatności przekazał nam informację o odrzuceniu transakcji#}.
</p>
<table class="nice">
	<tr>
		<th>{#Opis płatności#}</th>
		<td><strong>{$payment->text}</strong></td>
	</tr>
	<tr>
		<th>{#Cena#}</th>
		<td><strong>{if $payment->value > 0}{$payment->value|numberFormat} {#zł#}{else}{#za darmo#}{/if}</strong></a>
	</tr>
	<tr>
		<th>{#Opis błędu#}</th>
		<td>
			{if $request->error < 200}
			{#Wprowadzono niepełne dane, spróbuj ponownie#}.
			{elseif $request->error < 599 && $request->error >= 500}
			{#Brak autoryzacji, płatność nie może być zrealizowana, spróbuj ponownie#}.
			{else}
			{#System płatności internetowych przeciążony, spróbuj ponownie później#}...
			{/if}
		</td>
	</tr>
</table>
<p class="description">
	{#Jeśli tranasakcja została odrzucona ze względów technicznych, powiadom nas przez#} <a href="{@module=cms&controller=contact&action=index@}">{#formularz kontaktowy#}</a>. <br />
	<a style="width: 240px;" class="button" href="{@module=payment&controller=index&action=pay&id={$payment->id}&regenerate=1@}">{#zapłać ponownie#}</a>
</p>
