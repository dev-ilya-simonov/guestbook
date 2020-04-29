<?

\Bitrix\Main\Loader::registerAutoLoadClasses(null,  array(
    '\GuestBook\BookTable' => '/local/php_interface/classes/BookTable.php',
    '\GuestBook\General' => '/local/php_interface/classes/General.php'
));

function d($arr) {
    print_r('<pre>');
    print_r($arr);
    print_r('</pre>');
}