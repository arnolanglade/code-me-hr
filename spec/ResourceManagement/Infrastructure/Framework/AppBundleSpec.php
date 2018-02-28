<?php

namespace spec\Al\ResourceManagement\Infrastructure\Framework;

use Al\ResourceManagement\Infrastructure\Framework\AppBundle;
use Al\ResourceManagement\Infrastructure\Framework\ValidatorPass;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppBundleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AppBundle::class);
    }

    function it_is_a_bundle()
    {
        $this->shouldHaveType(Bundle::class);
    }

    function it_create_a_doctrine_mapping_driver(ContainerBuilder $container)
    {
        $container->addCompilerPass(Argument::type(DoctrineOrmMappingsPass::class))->shouldBeCalled();
        $container->addCompilerPass(Argument::type(ValidatorPass::class))->shouldBeCalled();

        $this->build($container)->shouldReturn(null);
    }
}
