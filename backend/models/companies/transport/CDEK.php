<?php


namespace app\models\companies\transport;


use app\models\companies\transport\contracts\ITransportCompany;
use app\models\packages\IPackage;

class CDEK implements ITransportCompany
{
    private $baseUrl;

    public function __construct(string $baseUrl = 'https://api.edu.cdek.ru/v2/calculator/tarifflist')
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @param IPackage $package - посылка для расчет тарифа.
     * @return float
     */
    public function fastTarif(IPackage $package): float
    {
        return rand(300, 1450); //иммитуруем подключение к апи и получаем тариф на бструю посылку
    }

    /**
     * @param IPackage $package - Посылка, для расчета тарифа
     * @return float
     */
    public function slowTarif(IPackage $package): float
    {
        return rand(100, 300); //иммитуруем подключение к апи и получаем тариф на медленную посылку
    }

    public function name(): string
    {
        return "СДЕК";
    }

    /**
     * Эмулируем запрос к ТК
     * @param IPackage $package
     * @return integer- дата доставки в timestamp
     * @throws \Exception
     */
    public function deliveryDate(IPackage $package): int
    {
        $dateTime = new \DateTime();
        $dateTime = $dateTime->modify('+4 day');
        return $dateTime->format('U');
    }
}