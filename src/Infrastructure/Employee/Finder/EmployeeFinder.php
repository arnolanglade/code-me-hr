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

namespace Al\Infrastructure\Employee\Finder;

use Al\Application\Employee\DTO\Employee as DTO;
use Al\Component\Employee\Employee;
use Al\Infrastructure\Specification\NewX;
use Doctrine\ORM\EntityManagerInterface;
use Happyr\DoctrineSpecification\Filter\Filter;
use Happyr\DoctrineSpecification\Query\QueryModifier;
use Happyr\DoctrineSpecification\Specification\Specification;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

final class EmployeeFinder
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(Specification $searchCriteria, $page = 1, $limit = 10)
    {
        $searchCriteria = new NewX(
            $searchCriteria,
            DTO::class
        );

        $queryBuilder = $this->entityManager->createQueryBuilder()
            ->from(Employee::class, 'employee');

        if ($searchCriteria instanceof QueryModifier) {
            $searchCriteria->modify($queryBuilder, 'employee');
        }

        if ($searchCriteria instanceof Filter &&
            $filter = $searchCriteria->getFilter($queryBuilder, 'employee')) {
            $queryBuilder->andWhere($filter);
        }

        // https://github.com/doctrine/doctrine2/issues/2596#issuecomment-162359732
        $employees = new Pagerfanta(new DoctrineORMAdapter($queryBuilder, false, false));
        $employees->setCurrentPage($page);
        $employees->setMaxPerPage($limit);

        return $employees;
    }
}
