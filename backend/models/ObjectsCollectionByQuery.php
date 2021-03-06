<?php


namespace app\models;


use app\models\media\ArrayMedia;
use app\models\media\IMedia;
use app\models\media\Printed;
use yii\db\Query;
use yii\helpers\VarDumper;

class ObjectsCollectionByQuery implements Printed
{
    private $query;
    private $exampleOfCreate;
    private $objectsType;


    public function __construct(Query $query, string $objectsType, callable $exampleOfCreate)
    {
        $this->exampleOfCreate = $exampleOfCreate;
        $this->query = $query;
        $this->objectsType = $objectsType;
    }

    public function printTo(IMedia $print): IMedia
    {
        $list = [];
        foreach ($this->query->each() as $record){
            /**@var Printed $object*/
            $object =  call_user_func($this->exampleOfCreate, $record);
            /**@var ArrayMedia $printedObject*/
            $printedObject = $object->printTo(new ArrayMedia());
            $list[] = $printedObject->attributesList();
        }
        $print->add($this->objectsType, $list);
        return $print;
    }
}