<?php


namespace app\models\packages;


use app\models\media\IMedia;
use app\models\media\tables\TablePackages;

class DefaultPackage implements IPackage
{
    private $row;

    public function __construct(TablePackages $row)
    {
        $this->row = $row;
    }

    /**
     * @param IMedia $media - источник ифнормации куда необхимо записать данные о посылке
     * @return IMedia - источник информации с вписанными данными о посылке
     */
    public function printTo(IMedia $media): IMedia
    {
        foreach ($this->row->getAttributes() as $key=>$attribute){
            $media->add($key, $attribute);
        }
        return $media;
    }
}