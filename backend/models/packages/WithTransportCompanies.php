<?php


namespace app\models\packages;


use app\models\companies\transport\contracts\ITransportCompany;
use app\models\media\IMedia;
use app\models\media\Printed;

class WithTransportCompanies implements Printed
{

    private $origin;
    private $companies;
    private $packageType;

    /**
     * WithTransportCompanies constructor.
     * @param IPackage $package
     * @param string   $packageType
     * @param ITransportCompany[]    $transportCompanies
     */
    public function __construct(IPackage $package, string $packageType, array $transportCompanies)
    {
        $this->origin = $package;
        $this->companies = $transportCompanies;
        $this->packageType = $packageType;
    }

    public function printTo(IMedia $print): IMedia
    {
        $media = $this->origin->printTo($print);
        $companiesData = [];
        foreach ($this->companies as $company){
            $companyArray = [];
            if($this->packageType == 'fast'){
                $companyArray['price']= $company->fastTarif();
            }else{
                $companyArray['coefficient']= $company->slowTarif() / 150;
            }
            $companiesData[$company->name()]= $companyArray;
        }
        return $media->add('transportCompanies', $companiesData);
    }
}