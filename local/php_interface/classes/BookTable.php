<?

namespace GuestBook;

use Bitrix\Main,
    Bitrix\Main\Application,
    Bitrix\Main\Entity,
    Bitrix\Main\Type;

class BookTable extends Main\Entity\DataManager
{

    const TABLE_NAME = 'my_guestbook';
    
    public static function createTable(){

        $connection = Application::getInstance()->getConnection();

        if (!$connection->isTableExists(static::getTableName()))
        {
            static::getEntity()->createDbTable();
            return true;
        }
        else
            return false;
    }

    public static function getTableName()
    {
        return static::TABLE_NAME;
    }
    
    public static function getMap()
    {
        return array(
            new Entity\IntegerField('ID',array( // Идентификатор
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true,
                'title' => 'ID записи',
            )),
            new Entity\DateField('DATE_CREATE', array( // Дата создания
                'data_type' => 'datetime',
                'title' => 'Дата создания записи',
                'default_value' => new Type\Date
            )),
            new Entity\StringField('NAME', array( // Имя пользователя
                'data_type' => 'string',
                'required' => true,
                'validation' => array(__CLASS__, 'validateName'),
                'title' => 'Имя пользователя',
            )),
            new Entity\TextField('COMMENT', array( // Комментарий
                'data_type' => 'text',
                'required' => true,
                'title' => 'Комментарий пользователя',
            )),
            new Entity\IntegerField('FILE', array( // Идентификатор
                'data_type' => 'integer',
                'title' => 'Прикреплённый файл',
                'default_value' => NULL
            ))
        );
    }

    public static function validateName()
    {
        return array(
            new Main\Entity\Validator\Length(null, 255),
        );
    }
}