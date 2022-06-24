<?php


namespace app\models\packages;


use app\models\media\IMedia;
use yii\helpers\VarDumper;

class FastPackage extends BasePackage implements IPackage
{

    /**
     * @param IMedia $media - источник ифнормации куда необхимо записать данные о посылке
     * @return IMedia - источник информации с вписанными данными о посылке
     */
    public function printTo(IMedia $media): IMedia
    {
        $media->add('weight', $this->weight)
            ->add('source_kladr', $this->source)
            ->add('target_kladr', $this->target)
            ->add('type', 'fast')
            ->commit();
        return $media;
    }
}