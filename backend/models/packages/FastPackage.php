<?php


namespace app\models\packages;


use app\models\media\IMedia;
use yii\helpers\VarDumper;

class FastPackage implements IPackage
{
    private $origin;

    public function __construct(IPackage $package)
    {
        $this->origin = $package;
    }

    /**
     * @param IMedia $media - источник ифнормации куда необхимо записать данные о посылке
     * @return IMedia - источник информации с вписанными данными о посылке
     */
    public function printTo(IMedia $media): IMedia
    {
        return
            $this->origin
                ->printTo($media)
                ->add('type', 'fast');
    }
}