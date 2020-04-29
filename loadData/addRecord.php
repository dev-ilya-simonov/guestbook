<?

namespace GuestBook;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)    die();

use GuestBook\General;

$dataArr = $_POST;
if($_FILES && !empty($_FILES))
    $dataArr['FILE'] = $_FILES['FILE'];
$recordID = General::createRecord($dataArr);

$res = General::getRecord($recordID);

if($res)
    echo json_encode($res);