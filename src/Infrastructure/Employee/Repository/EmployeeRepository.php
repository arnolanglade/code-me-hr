<?php
declare(strict_types=1);

namespace Infrastructure\Employee\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Component\Employee\EmployeeInterface;
use Component\Employee\EmployeeRepositoryInterface;
use Happyr\DoctrineSpecification\Filter\Filter;
use Happyr\DoctrineSpecification\Query\QueryModifier;
use Happyr\DoctrineSpecification\Specification\Specification;

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
    public function search(Specification $specification)
    {
        $qb = $this->createQueryBuilder('employee');
        $this->applySpecification($qb, $specification);
        $query = $qb->getQuery();

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function save(EmployeeInterface $employee)
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
            $specification->modify($queryBuilder, $queryBuilder->getRootAliases());
        }

        if ($specification instanceof Filter
            && $filter = (string) $specification->getFilter($queryBuilder, $queryBuilder->getRootAliases()[0])
        ) {
            $queryBuilder->andWhere($filter);
        }
    }
}