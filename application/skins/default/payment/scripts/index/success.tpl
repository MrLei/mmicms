<h1>{#Transakcja zakończona sukcesem#}</h1>
<p>
	{#Operator płatności przekazał nam informację o poprawnym zakończeniu transakcji, obecnie trwa weryfikacja wpłaty po stronie banku, lub operatora kart kredytowych#}.
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
</table>
<p class="description">
	{#Weryfikacja płatności trwa maksymalnie 24 godziny, po tym czasie otrzymasz stosowne powiadomienie e-mailem#}.	{#W razie dodatkowych pytań pozostajemy do dyspozycji#}: <a href="{@module=cms&controller=contact&action=index@}">{#formularz kontaktowy#}</a>.
</p>
