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
       return rand(300, 1450);
    }

    /**
     * @param IPackage $package
     * @return float
     */
    public function slowTarif(IPackage $package): float
    {
        return rand(150, 300);
    }

    public function name(): string
    {
        return 'boxberry';
    }

    /**
     * эмулируем запрос к тк
     * @param IPackage $package
     * @return integer- дата доставки в timestamp
     * @throws \Exception
     */
    public function deliveryDate(IPackage $package): int
    {
        $dateTime = new \DateTime();
        $dateTime = $dateTime->modify('+6 day');
        return $dateTime->format('U');
    }
}