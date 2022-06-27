<?php


namespace app\models\packages;


use app\models\companies\transport\contracts\ITransportCompany;
use app\models\companies\transport\contracts\TransportCompaniesFactory;
use app\models\media\IMedia;

class WithPrintedFastCost implements IPackage
{
    private $origin;
    private $factory;

    /**
     * WithPrintedFastCost constructor.
     * @param IPackage $origin
     * @param TransportCompaniesFactory $companies
     */
    public function __construct(IPackage $origin, TransportCompaniesFactory $companies)
    {
        $this->origin = $origin;
        $this->factory = $companies;
    }

    /**
     * @param IMedia $media - источник ифнормации куда необхимо записать данные о посылке
     * @return IMedia - источник информации с вписанными данными о посылке
     */
    public function printTo(IMedia $media): IMedia
    {
        $media = $this->origin->printTo($media);
        foreach ($this->factory->companies() as $company){
            $companyArray = [];
            $companyArray['price']= $company->fastTarif($this);
            $companyArray['period'] = $this->deliveryPeriod($company);
            $companiesData[$company->name()]= $companyArray;
        }
        return $media->add('transportCompanies', $companiesData);
    }

    private function deliveryPeriod(ITransportCompany $tc): int{
        $unix = $tc->deliveryDate($this->origin);
        $currentTime = time();
        $periodUnix = $unix-$currentTime;
        if($periodUnix <= 0 ){
            return 0;
        }
        return round($periodUnix / 86400);
    }
}