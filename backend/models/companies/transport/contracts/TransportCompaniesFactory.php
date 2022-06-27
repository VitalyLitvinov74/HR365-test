<?php


namespace app\models\companies\transport\contracts;


use app\models\companies\transport\Boxberry;
use app\models\companies\transport\CDEK;

class TransportCompaniesFactory
{
    private $_needleCompanies;

    /**
     * TransportCompaniesFactory constructor.
     * @param array $needleCompanies - пустой массив значит нужны все
     */
    public function __construct(array $needleCompanies = [])
    {
        $this->_needleCompanies = $needleCompanies;
    }

    /**
     * @return ITransportCompany[]
     */
    public function companies(): array{
        $list = [];
        foreach ($this->needleCompanies() as $needleCompany){
            switch ($needleCompany){
                default;
                case "CDEK":
                    $list['cdek'] = new CDEK();
                    break;
                case "boxberry":
                    $list['boxberry'] = new Boxberry();
                    break;
            }
        }
        return $list;
    }

    private function needleCompanies(): array{
        if(empty($this->_needleCompanies)){
            return [
                'CDEK',
                'boxberry'
            ];
        }
        return $this->_needleCompanies;
    }

}