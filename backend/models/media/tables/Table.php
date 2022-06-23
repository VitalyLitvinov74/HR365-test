<?php


namespace app\models\media\tables;


use app\models\media\IMedia;
use yii\db\ActiveRecord;
use yii\db\Exception;

abstract class Table extends ActiveRecord implements IMedia
{

    /**
     * Добавляет  в распространитель информации значения
     * @param string $key
     * @param        $value
     * @return IMedia
     */
    public function add(string $key, $value): IMedia
    {
        if(property_exists($this, $key)){
            $this->$key = $value;
        }
        return $this;
    }

    /**
     * Подтверждает введенные данные. Делает "слепок данных"
     * @return IMedia
     * @throws Exception
     */
    public function commit(): IMedia
    {
        if(!$this->validate()){
            throw new Exception('Сохраняемые данные не валидны', $this->getErrors());
        }
        if(!$this->save()){
            throw new Exception('Не удалось сохранить данные', $this->getErrors());
        }
        return $this;
    }
}