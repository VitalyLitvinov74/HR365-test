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

    public function fastTarif()
    {
        return rand(300, 1450); //иммитуруем подключение к апи и получаем тариф на бструю посылку
    }

    public function slowTarif()
    {
        return rand(100, 300); //иммитуруем подключение к апи и получаем тариф на медленную посылку
    }
}