<?

namespace GuestBook;

use Bitrix\Main;
use GuestBook\BookTable;

class General {

    public static function createRecord($data) {        
        BookTable::createTable();//Проверяем, существует ли таблица. Если нет - создаём
        if(!empty($data['FILE'])) {
            $data['FILE'] = self::saveFile($data['FILE']);
        }

        $result = BookTable::add($data);
        if($result->getId() > 0)
            return $result->getId();
        
        return false;
    }

    public static function getRecord($id){
        $res = BookTable::getRowById($id);
        $arResult = self::formatRecordArray($res);

        return $arResult;
    }

    public static function getRecords(){
        $res = BookTable::getList([
            'select' => ['*'],
            'order' => ['ID' => 'desc']
        ])->fetchAll();

        foreach($res as $k => $record):
            $arResult[$k] = self::formatRecordArray($record);
        endforeach;
        
        return $arResult;
    }

    public static function saveFile($arFile) {
        
        $fid = \CFile::SaveFile($arFile, "/guestBookFiles/");

        return $fid;
    }

    private function formatRecordArray($arr) {
        if($arr['FILE'] > 0) {
            $fileArr = \CFile::GetFileArray($arr['FILE']);
            $file['NAME'] = $fileArr['ORIGINAL_NAME'];
            $file['SRC'] = $fileArr['SRC'];
        } else 
            $file = 0;
        return [
            'ID'            => $arr['ID'],
            'DATE_CREATE'   => $arr['DATE_CREATE']->format('d.m.Y'),
            'NAME'          => $arr['NAME'],
            'COMMENT'       => $arr['COMMENT'],
            'FILE'          => $file
        ];
    }

}