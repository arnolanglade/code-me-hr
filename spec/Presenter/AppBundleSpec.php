<?php

namespace spec\Al\AppBundle;

use Al\AppBundle\AppBundle;
use Al\AppBundle\DependencyInjection\Compiler\ValidatorPass;
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
