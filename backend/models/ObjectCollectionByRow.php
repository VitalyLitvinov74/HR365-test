<?php


namespace app\models;


use app\models\media\IMedia;
use app\models\media\Printed;
use app\models\media\tables\Table;
use yii\db\ActiveRecord;

class ObjectCollectionByRow implements Printed
{
    private $exampleOfCreate;
    private $packageType;
    private $rowsOfTable;

    /**
     * ObjectCollectionByRow constructor.
     * @param ActiveRecord[] $rowsOfTable
     * @param string         $packageType
     * @param callable       $exampleOfCreate
     */
    public function __construct(array $rowsOfTable, string $packageType, callable $exampleOfCreate)
    {
        $this->rowsOfTable = $rowsOfTable;
        $this->packageType = $packageType;
        $this->exampleOfCreate = $exampleOfCreate;
    }

    public function printTo(IMedia $print): IMedia
    {
        $list = [];
        foreach ($this->rowsOfTable as $row){
            $list[] = call_user_func($this->exampleOfCreate, $row);
        }
        $print->add($this->packageType, $list);
        $print->commit();
        return $print;
    }
}