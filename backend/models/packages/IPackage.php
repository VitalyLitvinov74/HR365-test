<?php


namespace app\models\packages;


use app\models\media\IMedia;
use app\models\media\Printed;

/**
 * Посылка умеет только печатать себя куда то.
 * задачи о смене веса и пр. не стояло.
 */
interface IPackage extends Printed
{
    /**
     * @param IMedia $media - источник ифнормации куда необхимо записать данные о посылке
     * @return IMedia - источник информации с вписанными данными о посылке
     */
    public function printTo(IMedia $media): IMedia;
}