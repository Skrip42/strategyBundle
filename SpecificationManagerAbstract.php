<?php
namespace Skrip42\Bundle\StrategyBundle;

abstract class SpecificationManagerAbstract
{
    protected $specifications = [];

    public function addSpecification(SpecificationInterface $specification)
    {
        $this->specifications[] = $specification;
    }

    public function getFirst($criteria) : ?SpecificationInterface
    {
        foreach ($this->specifications as $spec) {
            if ($spec->isStatisfiedBy($criteria)) {
                return $spec;
            }
        }
        return null;
    }

    public function getAll($criteria) : array
    {
        $statisfied = [];
        foreach ($this->specifications as $spec) {
            if ($spec->isStatisfiedBy($criteria)) {
                $statisfied[] = $spec;
            }
        }
        return $statisfied;
    }
}
