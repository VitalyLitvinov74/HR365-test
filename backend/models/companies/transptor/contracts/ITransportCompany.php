<?php


namespace app\models\companies\transport\contracts;


interface ITransportCompany
{
    public function fastTarif();

    public function slowTarif();
}