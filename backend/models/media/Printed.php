<?php


namespace app\models\media;


interface Printed
{
    public function printTo(IMedia $print): IMedia;
}