<?php
namespace Skrip42\Bundle\StrategyBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class StrategyManagerInjectorPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $taggedServices = $container->findTaggedServiceIds('skrip42.strategy_manager');
        foreach ($taggedServices as $service => $value) {
            $manager = $container->getDefinition($service);
            $properties = $manager->getProperties();
            $strategies = $properties['strategy'];
            foreach ($strategies as $name => $strategy) {
                $manager->addMethodCall(
                    'addStrategy',
                    [
                        $name,
                        new Reference($strategy)
                    ]
                );
            }
            $manager->setProperty('strategy', []);
        }
    }
}
