<?php


namespace app\models\companies\transport;


use app\models\companies\transport\contracts\ITransportCompany;

class SDEK implements ITransportCompany
{
    private $baseUrl;

    public function __construct(string $baseUrl = 'https://api.edu.cdek.ru/v2/calculator/tarifflist')
    {
        $this->baseUrl = $baseUrl;
    }
}