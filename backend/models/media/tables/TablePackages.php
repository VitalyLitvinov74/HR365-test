<?php


namespace app\models\media\tables;


use app\models\media\IMedia;
use yii\db\ActiveRecord;

/**
 * @property int    $id           [int(11)]
 * @property string $source_kladr [varchar(255)]  Адрес отправки в формате КЛАДР
 * @property string $target_kladr [varchar(255)]  Адрес доаствки в формате КЛАДР
 * @property int    $weight       [int(11)]  Вес в граммах
 * @property int    $created      [timestamp]
 */
class TablePackages extends Table
{
    public static function tableName()
    {
        return 'packages';
    }
}