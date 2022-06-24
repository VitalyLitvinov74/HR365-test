<?php


namespace app\models\packages;


use app\models\media\IMedia;
use yii\db\Query;

class PackageBy implements IPackage
{
    private $query;

    public function __construct(Query $query)
    {

    }

    /**
     * @param IMedia $media - источник ифнормации куда необхимо записать данные о посылке
     * @return IMedia - источник информации с вписанными данными о посылке
     */
    public function printTo(IMedia $media): IMedia
    {
        // TODO: Implement printTo() method.
    }
}