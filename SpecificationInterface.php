<?php
namespace Skrip42\Bundle\StrategyBundle;

interface SpecificationInterface
{
    public function isStatisfiedBy($criteria) : bool;
}
