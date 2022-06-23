<?php


namespace app\models\media\tables;


/**
 * Class TableTransportCompanies
 * @package app\models\media\tables
 * @property int    $id   [int(11)]
 * @property string $name [varchar(255)]
 */
class TableTransportCompanies extends Table
{
    public static function tableName()
    {
        return 'transport_companies';
    }
}