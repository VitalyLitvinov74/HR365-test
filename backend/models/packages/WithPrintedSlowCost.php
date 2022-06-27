<?php


namespace app\models\packages;


use app\models\companies\transport\contracts\ITransportCompany;
use app\models\media\ArrayMedia;
use app\models\media\IMedia;
use app\models\media\Printed;

class WithPrintedSlowCost implements IPackage
{

    private $origin;
    private $companies;
    private $packageType;

    /**
     * WithTransportCompanies constructor.
     * @param IPackage $package
     * @param ITransportCompany[]    $transportCompanies
     */
    public function __construct(IPackage $package, array $transportCompanies)
    {
        $this->origin = $package;
        $this->companies = $transportCompanies;
    }

    public function printTo(IMedia $print): IMedia
    {
        foreach ($this->companies as $company){
            $companyArray = [];
            $companyArray['coefficient']= $company->slowTarif($this) / 150;
            $companiesData[$company->name()]= $companyArray;
        }
        return $print->add('transportCompanies', $companiesData);
    }
}