<?php


namespace app\models\packages;


use app\models\media\IMedia;
use app\models\media\Printed;

class WithTransportCompanies implements Printed
{
    public function __construct(IPackage $package, $transportCompanies)
    {
    }

    public function printTo(IMedia $print): IMedia
    {
        //добавить стоимость.
    }
}