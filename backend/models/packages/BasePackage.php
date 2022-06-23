<?php
namespace app\models\packages;

abstract class BasePackage
{
    protected $weight;
    protected $target;
    protected $source;

    public function __construct(string $source, string $target, float $weight)
    {
        $this->source = $source;
        $this->target = $target;
        $this->weight = $weight;
    }
}