<?php


namespace app\models\packages;


use app\models\companies\transport\contracts\ITransportCompany;
use app\models\media\IMedia;

class WithPrintedFastCost implements IPackage
{
    private $origin;
    private $companies;

    /**
     * WithPrintedFastCost constructor.
     * @param IPackage $origin
     * @param ITransportCompany[] $companies
     */
    public function __construct(IPackage $origin, array $companies)
    {
        $this->origin = $origin;
        $this->companies = $companies;
    }

    /**
     * @param IMedia $media - источник ифнормации куда необхимо записать данные о посылке
     * @return IMedia - источник информации с вписанными данными о посылке
     */
    public function printTo(IMedia $media): IMedia
    {
        return $this->origin->printTo($media);
    }
}