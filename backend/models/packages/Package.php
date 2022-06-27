<?php


namespace app\models\packages;


use app\models\media\IMedia;

class Package implements IPackage
{
    private $weight;
    private $source;
    private $target;
    public function __construct(string $sourceKladr, string $targetKladr, int $weight)
    {
        $this->target = $targetKladr;
        $this->source = $sourceKladr;
        $this->weight = $weight;
    }

    /**
     * @param IMedia $media - источник ифнормации куда необхимо записать данные о посылке
     * @return IMedia - источник информации с вписанными данными о посылке
     */
    public function printTo(IMedia $media): IMedia
    {
        return $media
            ->add('source_kladr', $this->source)
            ->add('target_kladr', $this->target)
            ->add('weight', $this->weight);
    }
}