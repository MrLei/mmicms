<h1>{#Wybierz metodę płatności#}</h1>
<p>
	{#Po wybraniu kanału płatności zostaniesz przekierowany na stronę operatora płatności#}.
</p>
<table class="nice">
	<tr>
		<th>{#Opis płatności#}</th>
		<td><strong>{$payment->text}</strong></td>
	</tr>
	<tr>
		<th>{#Kwota#}</th>
		<td><strong>{$payment->value|numberFormat} {#PLN#}</strong></a>
	</tr>
</table>
<div id="payBanks">
	<form action="https://www.platnosci.pl/paygw/UTF/NewPayment" method="POST" name="payform">
		<input type="hidden"name="first_name" value="{$paymentConfig->name}" />
		<input type="hidden"name="last_name" value="{$paymentConfig->surname}" />
		<input type="hidden"name="email" value="{$paymentConfig->email}" />
		<input type="hidden" name="pos_id" value="{$paymentConfig->shopId}" />
		<input type="hidden" name="pos_auth_key" value="{$paymentConfig->transactionKey}" />
		<input type="hidden" name="session_id" value="{$payment->sessionId}" />
		<input type="hidden" name="amount" value="{$paymentConfig->amount}" />
		<input type="hidden" name="desc" value="{$paymentConfig->desc}" />
		<input type="hidden" name="order_id" value="{$payment->id}" />
		<input type="hidden" name="client_ip" value="{$payment->ip}" />
		<input type="hidden" name="js" value="0">
		<script language="JavaScript" type="text/JavaScript" src='https://www.platnosci.pl/paygw/UTF/js/{$paymentConfig->shopId}/{$paymentConfig->key1|truncate:2:''}/paytype.js'></script>
		<script language="JavaScript" type="text/JavaScript">
			PlnDrawRadioImg(5);
		</script>
		<input class="submit button" type="submit" value="{#zapłać teraz#}">
	</form>
	<script language="JavaScript" type="text/javascript">document.forms['payform'].js.value = 1;</script>
</div>