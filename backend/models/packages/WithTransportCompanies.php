<?php


namespace app\models\packages;


use app\models\media\IMedia;

class WithTransportCompanies implements IPackage
{
    public function __construct(IPackage $package, $transportCompanies)
    {
    }

    /**
     * @param IMedia $media - источник ифнормации куда необхимо записать данные о посылке
     * @return IMedia - источник информации с вписанными данными о посылке
     */
    public function printTo(IMedia $media): IMedia
    {

    }
}