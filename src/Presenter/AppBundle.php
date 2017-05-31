<?php
declare(strict_types=1);

/*
 * This file is part of the AL labs package
 *
 * (c) Arnaud Langlade
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Al\AppBundle;

use Al\AppBundle\DependencyInjection\Compiler\ValidatorPass;
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
        $container->addCompilerPass(new ValidatorPass());
        $container->addCompilerPass(DoctrineOrmMappingsPass::createYamlMappingDriver(
            [__DIR__ . '/../Infrastructure/Employee/Resources/mapping' => 'Al\Component\Employee'],
            ['doctrine.orm.entity_manager']
        ));
    }
}
