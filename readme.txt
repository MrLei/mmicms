Pierwsze odpalenie MmiCms:

1.W g³ownym katalogu stwórz katalog tmp i ustaw mu wszystkie prawa ( 777 )
2.Zmieñ nazwê/skopiuj /application/configs/local.php.tmp na local.php
3.Otwórz local.php i ustaw w nim dane do bazy, stwórz wczeœniej odpowiedni¹ rolê, bazê, schemat, ew. u¿yj sqlite:

$_['db']['host'] = TMP_PATH . '/mmidb.sqlite';
$_['db']['driver'] = 'sqlite';

4.Odpal skrypt database/script/Update.php bezpoœrednio z php