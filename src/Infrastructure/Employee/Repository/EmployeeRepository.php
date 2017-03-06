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

namespace Al\Infrastructure\Employee\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Al\Component\Employee\EmployeeInterface;
use Al\Component\Employee\EmployeeRepositoryInterface;
use Happyr\DoctrineSpecification\Filter\Filter;
use Happyr\DoctrineSpecification\Query\QueryModifier;
use Happyr\DoctrineSpecification\Specification\Specification;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

final class EmployeeRepository extends EntityRepository implements EmployeeRepositoryInterface
{
    /**
     * @param EntityManager $entityManager
     * @param string        $classname
     */
    public function __construct(EntityManager $entityManager, $classname)
    {
        parent::__construct($entityManager, $entityManager->getClassMetadata($classname));
    }

    /**
     * {@inheritdoc}
     */
    public function match(Specification $specification)
    {
        $queryBuilder = $this->createQueryBuilder('employee');
        $this->applySpecification($queryBuilder, $specification);

        return new Pagerfanta(new DoctrineORMAdapter($queryBuilder));
    }

    /**
     * {@inheritdoc}
     */
    public function add(EmployeeInterface $employee)
    {
        $this->_em->persist($employee);
        $this->_em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function remove(EmployeeInterface $employee)
    {
        $this->_em->remove($employee);
        $this->_em->flush();
    }

    /**
     * @param QueryBuilder  $queryBuilder
     * @param Specification $specification
     */
    public function applySpecification(QueryBuilder $queryBuilder, Specification $specification)
    {
        if ($specification instanceof QueryModifier) {
            $specification->modify($queryBuilder, $queryBuilder->getRootAliases()[0]);
        }

        if ($specification instanceof Filter
            && $filter = (string) $specification->getFilter($queryBuilder, $queryBuilder->getRootAliases()[0])
        ) {
            $queryBuilder->andWhere($filter);
        }
    }
}
