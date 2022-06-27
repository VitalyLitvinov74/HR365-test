<?php


namespace app\models\companies\transport\contracts;


use app\models\packages\IPackage;

interface ITransportCompany
{
    /**
     * @param IPackage $package
     * @return float
     */
    public function fastTarif(IPackage $package): float;

    /**
     * @param IPackage $package
     * @return float
     */
    public function slowTarif(IPackage $package): float;

    /**
     * @param IPackage $package
     * @return integer- дата доставки в timestamp
     */
    public function deliveryDate(IPackage $package): int;

    public function name(): string;
}