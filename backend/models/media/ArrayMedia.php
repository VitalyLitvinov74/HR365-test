<?php


namespace app\models\media;


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

    }

    /**
     * Подтверждает введенные данные. Делает "слепок данных"
     * @return IMedia
     */
    public function commit(): IMedia
    {

    }
}