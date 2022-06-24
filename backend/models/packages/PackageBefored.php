<?php


namespace app\models\packages;


use app\models\media\IMedia;
use yii\base\Exception;
use yii\helpers\VarDumper;

class PackageBefored implements IPackage
{
    private $workBefore;
    private $origin;

    /**
     * PackageBefored constructor.
     * @param IPackage $package
     * @param string   $workBefore - Время в формате 01:22, 18:00
     */
    public function __construct(IPackage $package, string $workBefore)
    {
        $this->workBefore = $workBefore;
        $this->origin = $package;
    }

    /**
     * @param IMedia $media - источник ифнормации куда необхимо записать данные о посылке
     * @return IMedia - источник информации с вписанными данными о посылке
     * @throws Exception
     */
    public function printTo(IMedia $media): IMedia
    {
        if(strtotime("now") < strtotime($this->workBefore)){
            return $this->origin->printTo($media);
        }
        throw new Exception("Мы работает до " . $this->workBefore);
    }
}