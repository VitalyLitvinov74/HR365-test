<?php


namespace app\models\companies\transport;


use app\models\companies\transport\contracts\ITransportCompany;
use app\models\media\ArrayMedia;
use app\models\packages\IPackage;

class Boxberry implements ITransportCompany
{
    private $printedArray;
    public function __construct()
    {
        $this->printedArray = new ArrayMedia([]);
    }

    /**
     * @param IPackage $package
     * @return float
     */
    public function fastTarif(IPackage $package): float
    {
       return rand();
    }

    /**
     * @param IPackage $package
     * @return float
     */
    public function slowTarif(IPackage $package): float
    {
        // TODO: Implement slowTarif() method.
    }
}