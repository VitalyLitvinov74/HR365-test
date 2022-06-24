<?php


namespace app\models\media;


interface IMedia
{
    /**
     * Добавляет  в распространитель информации значения
     * @param string $key
     * @param        $value
     * @return IMedia
     */
    public function add(string $key, $value): IMedia;

    /**
     * Подтверждает введенные данные. Делает "слепок данных"
     * @return IMedia
     */
    public function commit(): IMedia;

    public function attributesList();
}