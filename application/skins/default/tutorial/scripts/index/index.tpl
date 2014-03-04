<style>
pre {
border: #000000 1px solid;
padding: 10px 0 10px 10px;
margin-right: -12px; 
color: blue;
background: #f0f0ff;
}
</style>
<h2>MMI Framework Tutorial</h2>
<p>Witaj w tutorialu pozwalającym przybliżyć Ci pracę z Frameworkiem MMI.</p>

<ol>
	<li><a href="#podstawy">Podstawy</a>
		<ul>
			<li><a href="#kontroler">Kontroler</a></li>
			<li><a href="#widok">Widok</a></li>
		</ul>
	</li>
	<li><a href="#helloworld">Tworzenie pierwszej strony "Hello World"</a>
	<li><a href="#formularz">Prosty Formularz</a> 
		<ul>
			<li><a href="#zapisywanie">Zapisywanie Danych</a></li>
			<li><a href="#obsluga">Obsługa Formularzy</a></li>
			<li><a href="#przyklad">Przykładowy Formularz</a></li>
		</ul>
	</li>
	{*<li><a>Podpinanie javascript/css</a>
	<li><a>Pierwsze kroki - DataFlow</a>
	<li><a>Rejestrcja pluginów</a>-->*}
</ol>

<h1 id="podstawy">Podstawy</h1>
	<div style="margin-left: 10px;">
		<p>@ Główny plik uruchamiający MMI (index.php) znajduje się w katalogu public, to do niego kierowany jest cały ruch za pomocą mod_rewrite zdefiniowanego w .htaccess
		<pre>mmicms/public/index.php</pre>
		
		<p>@ Po uruchomieniu indexu i przejściu przez wiele procesów opisanych później (DataFlow) ostatecznie lądujemy w katalogu
		<pre>application/modules</pre>
		gdzie znajdują się moduły które tak naprawdę są naszymi przyszłymi stronami(projektami,widgetami). Zawsze domyślnie ładowany jest Moduł 'Default'
		<pre>application/modules/Default/</pre>

		<h3 id="kontroler">Kontroler</h3>
		<p>Zgodnie z modelem MVC pierwszym krokiem przy uruchamianiu aplikacji jest wykonanie kontrolera.<br>
		W tym celu uruchamiany jest plik
		<pre>application/modules/Default/Controller/Index.php</pre>

		<p>W kontrolerze zdefiniowane są Akcje które będą uruchamiane w zależności od wywołania strony (url). Nie tworzymy tutaj samej strony a bardziej logikę która wykorzystując model ma wyprodukować dane i przekazać je do widoku.

		<p>Podstawowy kontroler jest to obiekt dziedziczący z abstrackyjnej klasy Mmi_Controller_Action i posiada metody o nazwach zdefiniowane wg. schematu:
		<pre>public function NazwaAkcjiAction() {}</pre>
		domyślne uruchamiana jest metoda indexAction();<br>
		przykładowa klasa kontrolera:<br>
		<pre>&#60;?php

class Default_Controller_Index extends Mmi_Controller_Action {

	public function indexAction() {
		//co ma się wydarzyć po wywołaniu domyślnej strony
		//url: domena.test/NazwaModułu/
	}

	public function fooAction() {
		//co ma się wydarzyć po wywołaniu /foo
		//url: domena.test/NazwaModułu/foo
	}

}</pre>

		<p>Rolą kontrolera jest przekazanie danych do widoku. Robimy to w nastepujący sposób:
		<pre>$this->view->hello = "Hello world!";</pre>
		<p>Dzięki tak skonstruowanej komendzie będziemy mogli w widoku dostać się do przekazanych z kontrolera danych za pomocą zmiennej $hello. Nie musimy deklarować zmiennej $hello w widoku zostanie ona zdefiniowana automatycznie.
		
		<h3 id="widok">Widok</h3>

		<p>Po wykonaniu poleceń kontrolera framework przystępuje do renderowania strony. W tym celu uruchamia odpowiedni zdefiniowany przez nas template z katalogu:
		<pre>application/skins/default/</pre>
		
		<p>Ostatni człon to nazwa skórki. Możemy mieć wiele skórek. Nazwę aktualnej skórki definiujemy w configu. Jeżeli nie zostanie ona zdefiniowana domyślnie renderowana jest skórka 'default'
		
		<p>Struktura tego katalogu jest odbiciem lustrzanym naszych plików/metod z kontrolera. Każda metoda ma swój odpowiednik jako plik .tpl<br>
		np.:
		<pre>
naszemu domyślnemu indexowi:
application/    modules  /Default/Controller/Index.php indexAction
odpowiada plik template:
application/skins/default/Default/ scripts  /index     /index.tpl</pre>

		<p>inny przykład:
		<pre>application/    modules  /Admin/Controller/Index.php indexAction
application/skins/default/Admin/ scripts  /index     /index.tpl</pre>

		<pre>application/    modules  /Admin/Controller/Index.php PasswordAction
application/skins/default/Admin/ scripts  /index     /password.tpl</pre>

		<pre>application/    modules  /Admin/Controller/ErrorLog.php traceAction
application/skins/default/Admin/ scripts  /errorLog     /trace.tpl</pre>

		<p>w plikach .tpl opisujemy kod zwracany do przeglądarki. Jest to imperatywny kod opisujący to co ma zostać zwrócone do przeglądarki. 
		Można powiedzieć że jest to skrócona wersja php przystosowana to zagnieżdżania w tekście. Jest on bardzo podobny do śilnika templatów tzw. Smarty.<br>
		Przykładowy kod:

		<pre>&#123;foreach &#36;foo as &#36;bar&#125;
  &#60;a href="&#123;&#36;bar.zig&#125;">&#123;&#36;bar.zag&#125;&#60;/a>
  &#60;a href="&#123;&#36;bar.zig2&#125;">&#123;&#36;bar.zag2&#125;&#60;/a>
  &#60;a href="&#123;&#36;bar.zig3&#125;">&#123;&#36;bar.zag3&#125;&#60;/a>
&#123;/foreach&#125;</pre>

		<p>jest to odpowiednik kodu php:

		<pre>&#60;?php foreach(&#36;foo as &#36;bar): ?>
   &#60;a href="&#60;?=&#36;bar['zig']?>">&#60;?=&#36;bar['zag']?></a>
   &#60;a href="&#60;?=&#36;bar['zig2']?>">&#60;?=&#36;bar['zag2']?></a> 
   &#60;a href="&#60;?=&#36;bar['zig3']?>">&#60;?=&#36;bar['zag3']?></a> 
&#60;?php endforeach; ?></pre>

		<p><b>Generalne zasady:</b><br>
		<b>&#123;&#125;</b> - Każdą funkcjonalność umieszczamy w nawiasach  - &#123;kod....&#125;<br>
		<b>&#36;</b>  - do zmiennych odnosimy się poprzez &#36; - &#123;&#36;hello&#125;

		<p><b>Funkcje:</b><br>
		<b>==</b> - wstawianie tekstów statycznych<br>
		najczęściej są one używane jako znaczniki do zastąpienia przez tekst wpisany w CMS
		<pre>&#123;=Hello World!=&#125;</pre>

		<p style="margin-top:20px;"><b>##</b> - wstawianie tesktów podatnych na tłumaczenie<br>
		jeśli zajdzie taka potrzeba i znajduje się odpowiednie tłumaczenie:<br>
		<pre>&#123;#Witamy na stronie!#&#125;</pre>
		odpowiada<br>
		<pre>&#60;?php _translate('Witamy na stronie') ?&#62;</pre>
		
		<p style="margin-top:20px;"><b>@@</b> - generowanie linków:<br>
		<pre>&#123;@module=admin&controller=index&action=password@&#125;</pre>
		odpowiada<br>
		<pre>http://www.test.pl/admin/password</pre>
		lub
		<pre>&#123;@module=default@&#125;   ==   http://www.test.pl/default/</pre>

		<p style="margin-top:20px;"><b>''</b> - wstawianie template:
		<pre>&#123;'default/scripts/error.tpl'&#125;</pre>

		<p style="margin-top:20px;"><b>**</b> - komentarz

		<p style="margin-top:20px;"><span style="color:red">- deprecated -</span> metoda nie używana ze względu na używanie css'a do grafik<br>
		<b>%%</b> - Zwraca ścieżkę do pliku leżącego w skórze (katalog public/&#123;nazwa skóry&#125; )<br>
		<pre>&#123;%logo.png%&#125;</pre>
		odpowiada
		<pre>http://www.test.pl/default/default/images/logo.png</pre>

		<p><b>Instrukcje wartunkowe / pętle</b><br>
		<pre>&#123;if &#36;a == 3&#125;
    &#60;p>a równa się 3&#60;/p>
&#123;elseif &#36;a == 2&#125;
    &#60;p>a równa się 2&#60;/p>
&#123;else&#125;
    &#60;p>a nie równa się ani 3, ani 2&#60;/p>
&#123;/if&#125;</pre>

		<pre>&#123;for &#36;i=0; &#36;i<=3; i++&#125;
    &#60;p>a teraz &#123;&#36;i&#125;&#60;/p>
&#123;/for&#125;</pre>

		<pre>&#123;foreach &#36;items as &#36;item&#125;
    &#60;p>jestem &#123;&#36;item&#125;&#60;/p>
	&#123;break&#125;
&#123;/foreach&#125;</pre>

		<pre>&#123;while &#36;i == null&#125;
	&#60;p>Wykonuje się w nieskończoność!&#60;/p>
&#123;/while&#125;</pre>

		<p><b>Korzystanie z helperów</b><br>
		Wywołanie nazwy helpera z () na końcu powoduje otrzymanie instancji helpera,
		jeżeli takowy znajduje się w katalogu:
		<pre>library/{nazwa aplikacji}/view/helper/</pre>
		Przykładowe helpery:<br>
		navigation()<br>
		headLink()<br>
		headScript()<br>
		messenger()<br>
		widget()

		<p>wyjątkiem jest:<br>
		content() - ta metoda użyta w layout.tpl wskazuje miejsce zagnieżdżenia zawartości

		<p>Przykłady użycia helperów:
		<pre>&#123;navigation()->title()&#125;</pre>
		<pre>&#123;navigation()->setRoot(101)->menu()&#125;</pre>
		<pre>&#123;headLink()->appendStyleSheet(&#36;baseUrl . '/default/default/style.css')&#125;</pre>
		<pre>&#123;widget('news', 'index', 'top', array(), 360)&#125;</pre>
	</div>
<h1 id="helloworld">Tworzenie pierwszej strony "Hello World"</h1>
	<div style="margin-left: 10px;">
		<p>Zaczynamy od tworzenia struktury katalogów:<br>
		W katalogu
		<pre>application/modules/</pre>
		tworzymy katalog o nazwie naszego modułu z dużej litery np. Tutuorial a w nim katalog Controller. 
		W środku tworzymy plik index.php który otwiramy w edytorze i wpisujemy do niego następującą treść:

		<pre>&#60;?php

class Tutorial_Controller_Index extends Mmi_Controller_Action {

	public function indexAction() {
		&#36;this->view->hello = "Hello world!";
	}

}</pre>

		<p>Teraz w katalogu
		<pre>application/skins/default/</pre>
		tworzymy katalog o nazwie naszego modułu z małej litery np. tutorial a w nim katalog scripts. W środku tworzymy katalog index (nazwa pliku naszego kontrolera) a w środku plik 
		index.tpl (nazwa akcji w pliku kontrolera).<br>
		Wpisujemy do index.tpl:

		<pre>&#60;h1>&#123;&#36;hello&#125;&#60;/h1></pre>

		<p>i zapisujemy.<br>
		Musimy jeszcze dodać uprawnienia do oglądania tej strony dla gości w panelu administracyjnym i to wszystko
		pod adresem 
		<pre>http://www.test.pl/mmicms/public/tutorial/</pre>
		będzie widoczna nasza strona.
	</div>
<h3 style="margin-bottom: 12px; margin-top: 20px;">Efekt:</h3>
<h1>{$hello}</h1>
<h1 id="formularz" style="margin-top:30px;">Prosty Formularz</h1>
	<div style="margin-left: 10px;">
		<p>Aby stworzyć formularz musimy na początek stworzyć jego klasę. W tym celu tworzymy katalog Form w katalogu naszego projektu
		<pre>application/Tutorial/Form/</pre>
		<p>a następnie tworzymi w nim plik o nazwie naszego forumularze, np. Test (z dużej litery). W pliku Test.php wklejamy następujący kod:
		<pre>&#60;?php

class Tutorial_Form_Test extends Mmi_Form {
	
	public function init() {
	
		$this->addElementText('data')
				->setLabel('Wpisz jakieś dane:')
				->addFilter('StringTrim')
				->setDescription('')
				->setValue('')
				->setRequired()
				->addValidatorStringLength(2, 128, 'Wprowadź poprawne dane.');
		
		$this->addElementSubmit('add')
				->setLabel('dodaj');

	}	
} 
?></pre>
		<p>Jak widać z powyższego kodu formularz jest to nic innego jak obiekt dziedziczący po abstrakcyjnej klasie Mmi_Form. W super klasie znajdziemy 
		   cały zestaw interesujących nas metod do tworzenia formularzy. Typy dostępnych formularzy znajdziemy jako podklasy w katalogu:
		<pre>library/Mmi/Form/Element/</pre>
		<p>w metodzie init() którą musimy rozszerzyć opisujemy całą funkcjonalność jaką będzie posiadał nasz formularz.
		<p>W tym konkretnym przykładzie utworzyliśmy pole typu text oraz przycisk potwierdzający, będziemy chcieli aby dane wpisane do pola tekst po 
		   potwierdzeniu przyciskiem dodaj zostały zapisane do bazy danych.
		<p>Tak przygotowaną klase możemy już wykorzystać w naszym kontroleże tak więc dopisujemy do indexu nową akcje w której tworzymy obiekt naszego formularza:
		<pre>&#60;?php

class Tutorial_Controller_Index extends Mmi_Controller_Action {

	public function indexAction() {
		$this->view->hello = "Hello world!";
	}
	
	public function simpleFormAction() {
		$form = new Tutorial_Form_Test();
	}
}</pre>
		<p>Teraz przechodzimy do wizualnej reprezentacji naszego formularze czyli tworzymy template do naszej akcji. Zgodnie ze sztuką tworzymy plik simpleForm.tpl w naszym widoku
		<pre>application/skins/default/tutorial/scripts/index/simpleForm.tpl</pre>
		<p>i wklejamy do środka następujący kod:
		<pre>&#60;h1>Witaj w przykładowym formularzu&#60;/h1>
&#123;$testForm&#125;</pre>
		<p>warto zaznaczyć że formularze automatycznie przekazują się do widoku i można dostać się donich 
		   poprzez akcesor złożony z nazwy formularza 'test' i nazyw katalogu w którym się znajduje 'Form'.
		   Domyślnie wywoływana jest metoda render() i w ten sposób możemy już w tym momencie wyświetlić nasz formularz.
		<h3 id="zapisywanie">Zapisywanie danych</h3>
		<p>No dobrze, ale chcemy aby nasz formularz coś robił a nie tylko wyglądał, aby formularz był w stanie zapisywać dane
		   musimy go zaopatrzeć w taką możliwość podłączając go do naszej maski połączenia z bazą (DAO) w tym celu w
		   katalogu naszego modułu tworzymy katalog Model a w nim katalog z nazwą naszej akcji:
		<pre>application/modules/Tutorial/Model/SimpleForm/</pre>
		<p>w tym katalogu musimy stworzyć 2 pliki Dao.php oraz Record.php. Zacznijmy od recordu:
		<pre>&#60;?php

class Tutorial_Model_SimpleForm_Record extends Mmi_Dao_Record {

	public function saveMyData() {
		//obrabiamy nasze dane przed zapisem do bazy
		return parent::save();
	}

}</pre>
		<p>w klasie rekordu tworzymy metodę której zadaniem jest obróbka danych przed zapisem do bazy
		   ostatecznie musi być wykonana metoda save z nadklasy, jeżeli nie zdefiniujemy tej metody, domyślnie zostanie wykonana metoda save();
		<p>Teraz jak już stworzyliśmy nasz rekord musimy podpiąć go pod nasz formularz, w tym celu dopisujemy do pliku simpleForm.php 2 linijki:
		<pre>class Tutorial_Form_Test extends Mmi_Form {
	protected $_recordName = 'Tutorial_Model_SimpleForm_Record';
	protected $_recordSaveMethod = 'saveMyData';
	
	public function init() {
	...</pre>
		<p>W pierwszej linijce podajemy nazwę klasy naszego rekordu, w drugiej określamy nazwe klasy obróbki naszych danych
		<p>Został nam jeszcze do utworzenia plik Dao.php, tworzymy go tam gdzie Record.php i wpisujemy do niego następującą treść:
		<pre>&#60;?php

class Tutorial_Model_SimpleForm_Dao extends Mmi_Dao {

	protected static $_tableName = 'tutorial_form_test';

}
		</pre>
		<p>Jest to obiekt dziedziczący po klasie Mmi_Dao, definiujemy w nim nazwe tabeli w naszej bazie danych do której zapisywane będą dane.
		   Oczywiście żeby wszystko działało musimy taką tabelę wcześniej stworzyć. Kolumny jakie musimy stworzyć to 'id' o typie serial, oraz 
		   po jednej kolumnie na każdą kontrolke formularza która coś zapisuje o nazwie takiej jak nazwa kontrolki.
		   
		<h3 id="obsluga">Obsługa Formularzy</h3>
		<p>Po wypełnieniu i zatwierdzeniu formularza, jest on obsługiwany zawsze przez tą są samą akcje w której został stworzony, innymi słowy 
			parametr action w form jest ustawiony na stronę na której jest formularz, dlatego musimy zapewnić w tej akcji jego obsługę.
		<p>Po wypełnieniu naszego formularza chcielibyśmy przenieść użytkownika na stronę z podziękowaniem, w tym celu tworzymy akcję z podziękowaniem
		oraz modyfikujemy akcję formularza i dodajemy obsługę, że jeżeli formularz zapisał dane to przekierowujemy użytkownika na stronę z podziękowaniem</p>
		<pre>&#60;?php

class Tutorial_Controller_Index extends Mmi_Controller_Action {

	public function indexAction() {
		$this->view->hello = "Hello world!";
	}
	
	public function simpleFormAction() {
		$form = new Tutorial_Form_Test();
		if ($form->isSaved()) {
			return $this->_helper->redirector(
				'thankYou', 'index', 'tutorial', 
				array(), true);
		}
	}
	
	public function thankYouAction() {}

}</pre>
		<p>Zgodnie ze sztuką tworzymy również template thankYou.tpl w katalogu
		<pre>application/skins/default/tutorial/scripts/index/</pre>
		<p>z następującą treścią:
		<pre>&#60;h1>Dziękujemy za dokonanie wpisu&#60;/h1>&#60;br>
&#60;a href="{@module=tutorial@}"><< Wróć&#60;/a></pre>
		<p>Teraz musimy dodać obsługę formularza w akcji:
		<pre>...
	public function simpleFormAction() {
		$form = new Tutorial_Form_Test();
		if ($form->isSaved()) {
			return $this->_helper->redirector('thankYou', 
				'index', 'tutorial', array(), true);
		}
	}
...</pre>
		<p>Najlepszym sposobe na sprawdzenie czy formularz został wykonany jest sprawdzenie to metodą isMine() lub isSaved() w zależności czy dodaliśmy obsługę zapisu w naszym formularzu.
		<h3 id="przyklad">Przykładowy formularz:</h3>
		{$transferForm}
	</div>