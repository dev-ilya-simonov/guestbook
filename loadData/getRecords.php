<?

namespace GuestBook;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)    die();

use GuestBook\General;

$res = General::getRecords();

if($res)
    echo json_encode($res);