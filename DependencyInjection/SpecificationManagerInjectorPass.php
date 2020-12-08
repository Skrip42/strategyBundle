<?php
namespace Skrip42\Bundle\StrategyBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class SpecificationManagerInjectorPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $taggedServices = $container->findTaggedServiceIds('skrip42.specification_manager');
        foreach ($taggedServices as $service => $value) {
            $manager = $container->getDefinition($service);
            $properties = $manager->getProperties();
            $specifications = $properties['specification'];
            foreach ($specifications as $specification) {
                $manager->addMethodCall(
                    'addSpecification',
                    [
                        new Reference($specification)
                    ]
                );
            }
            $manager->setProperty('specification', []);
        }
    }
}
