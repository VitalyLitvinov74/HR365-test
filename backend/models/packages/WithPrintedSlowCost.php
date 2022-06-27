<?php


namespace app\models\packages;


use app\models\companies\transport\contracts\ITransportCompany;
use app\models\companies\transport\contracts\TransportCompaniesFactory;
use app\models\media\ArrayMedia;
use app\models\media\IMedia;
use app\models\media\Printed;
use DateTime;

class WithPrintedSlowCost implements IPackage
{

    private $origin;
    private $factory;

    /**
     * WithTransportCompanies constructor.
     * @param IPackage $package
     * @param TransportCompaniesFactory    $transportCompanies
     */
    public function __construct(IPackage $package, TransportCompaniesFactory $transportCompanies)
    {
        $this->origin = $package;
        $this->factory = $transportCompanies;
    }

    public function printTo(IMedia $print): IMedia
    {
        $print = $this->origin->printTo($print);
        foreach ($this->factory->companies() as $company){
            $companyArray = [];
            $companyArray['coefficient']= round($company->slowTarif($this->origin) / 150, 2);
            $companyArray['date'] = $this->diliveryDate($company);
            $companiesData[$company->name()]= $companyArray;
        }
        return $print->add('transportCompanies', $companiesData);
    }

    /**
     * @param ITransportCompany $tc
     * @return string
     * @throws \Exception
     */
    private function diliveryDate(ITransportCompany $tc): string{
        $dateTime  = new DateTime();
        $dateTime->setTimestamp($tc->deliveryDate($this->origin));
        return $dateTime->format('Y-m-d');
    }
}