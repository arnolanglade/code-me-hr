<?php

namespace AppBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(DoctrineOrmMappingsPass::createYamlMappingDriver(
            [__DIR__.'/../Infrastructure/Employee/Resources/mapping' => 'Component\Employee'],
            ['doctrine.orm.entity_manager']
        ));
    }
}
