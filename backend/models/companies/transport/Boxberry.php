<?php


namespace app\models\companies\transport;


use app\models\companies\transport\contracts\ITransportCompany;

class Boxberry implements ITransportCompany
{

    public function fastTarif()
    {
        return rand(300, 1450); //иммитуруем подключение к апи и получаем тариф на бструю посылку
    }

    public function slowTarif()
    {
        return rand(100, 300); //иммитуруем подключение к апи и получаем тариф на медленную посылку
    }
}