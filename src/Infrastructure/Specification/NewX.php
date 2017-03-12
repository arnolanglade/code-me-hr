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

namespace Al\Infrastructure\Specification;

use Doctrine\ORM\QueryBuilder;
use Happyr\DoctrineSpecification\Specification\Specification;

final class NewX implements Specification
{
    /** @var Specification */
    private $child;

    /** @var string */
    private $className;

    /**
     * @param Specification $child
     * @param string        $className
     */
    public function __construct(Specification $child, string $className)
    {
        if (!class_exists($className)) {
            throw new \LogicException('The class %s does not exist');
        }

        $this->child = $child;
        $this->className = $className;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param string       $dqlAlias
     *
     * @return string
     */
    public function getFilter(QueryBuilder $queryBuilder, $dqlAlias): string
    {
        return (string) $this->child->getFilter($queryBuilder, $dqlAlias);
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param string       $dqlAlias
     */
    public function modify(QueryBuilder $queryBuilder, $dqlAlias)
    {
        $queryBuilder->select(sprintf('NEW %s(%s)', $this->className, $this->formatFields($dqlAlias)));

        $this->child->modify($queryBuilder, $dqlAlias);
    }

    /**
     * @param string $dqlAlias
     *
     * @return string
     */
    private function formatFields(string $dqlAlias): string
    {
        $constructor = (new \ReflectionClass($this->className))->getConstructor();
        $parameters = $constructor->getParameters();

        $fields = [];
        foreach ($parameters as $parameter) {
            $fields[] = sprintf('%s.%s', $dqlAlias, $parameter->getName());
        }

        return implode(', ', $fields);
    }
}
