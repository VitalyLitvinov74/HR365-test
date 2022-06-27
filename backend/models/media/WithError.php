<?php


namespace app\models\media;


class WithError implements Printed
{
    private $origin;

    public function __construct(Printed $origin)
    {
        $this->origin = $origin;
    }


    public function printTo(IMedia $print): IMedia
    {
        try{
            return $this->origin
                ->printTo($print)
                ->add('error', '');
        }catch (\Exception $exception){
            return $print->add('error', $exception->getMessage());
        }
    }
}