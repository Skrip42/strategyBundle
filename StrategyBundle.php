<?php
namespace Skrip42\Bundle\StrategyBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Skrip42\Bundle\StrategyBundle\DependencyInjection\StrategyManagerInjectorPass;
use Skrip42\Bundle\StrategyBundle\DependencyInjection\SpecificationManagerInjectorPass;

class StrategyBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(
            new StrategyManagerInjectorPass(),
            PassConfig::TYPE_BEFORE_REMOVING
        );
        $container->addCompilerPass(
            new SpecificationManagerInjectorPass(),
            PassConfig::TYPE_BEFORE_REMOVING
        );
    }
}
