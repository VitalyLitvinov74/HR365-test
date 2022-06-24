<?php


namespace app\models\media;


use yii\helpers\VarDumper;

class ArrayMedia implements IMedia
{
    private $start;

    public function __construct($start = [])
    {
        $this->start = $start;
    }

    /**
     * Добавляет  в распространитель информации значения
     * @param string $key
     * @param        $value
     * @return IMedia
     */
    public function add(string $key, $value): IMedia
    {
        $this->start[$key] = $value;
        return $this;
    }

    /**
     * Подтверждает введенные данные. Делает "слепок данных"
     * @return IMedia
     */
    public function commit(): IMedia
    {
        return $this;
    }

    public function attributesList()
    {
        return $this->start;
    }
}