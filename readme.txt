Pierwsze odpalenie MmiCms:

1.W g�ownym katalogu stw�rz katalog tmp i ustaw mu wszystkie prawa ( 777 )
2.Zmie� nazw�/skopiuj /application/configs/local.php.tmp na local.php
3.Otw�rz local.php i ustaw w nim dane do bazy, stw�rz wcze�niej odpowiedni� rol�, baz�, schemat, ew. u�yj sqlite:

$_['db']['host'] = TMP_PATH . '/mmidb.sqlite';
$_['db']['driver'] = 'sqlite';

4.Odpal skrypt database/script/Update.php bezpo�rednio z php