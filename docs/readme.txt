Pierwsze odpalenie MmiCms:

1. W głównym katalogu stwórz katalog tmp i ustaw mu wszystkie prawa ( 777 )
2. Zmień nazwę/skopiuj /application/configs/local.php.tmp na local.php
3. Otwórz local.php i ustaw w nim dane do bazy, stwórz wcześniej odpowiednią rolę, bazę, schemat, ew. użyj sqlite:

$_['db']['host'] = TMP_PATH . '/mmidb.sqlite';
$_['db']['driver'] = 'sqlite';

4. Odpal skrypt database/script/Update.php bezpośrednio z php-cli