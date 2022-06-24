<?php


namespace app\models;


use app\models\media\IMedia;
use app\models\media\Printed;

class ObjectsCollection implements Printed
{
    private $objects;
    private $type;

    public function __construct(array $objects, string $type)
    {
        $this->objects = $objects;
        $this->type = $type;
    }

    public function printTo(IMedia $print): IMedia
    {

    }
}