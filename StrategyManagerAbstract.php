<?php
namespace Skrip42\Bundle\StrategyBundle;

abstract class StrategyManagerAbstract
{
    protected $strategies = [];

    public function addStrategy(string $name, StrategyInterface $strategy)
    {
        $this->strategies[$name] = $strategy;
    }

    public function get(string $name) : ?StrategyInterface
    {
        return $this->strategies[$name] ?? null;
    }
}
