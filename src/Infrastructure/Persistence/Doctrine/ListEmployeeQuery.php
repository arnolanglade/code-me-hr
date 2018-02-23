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

namespace Al\Infrastructure\Persistence\Doctrine;

use Al\Domain\Employee;
use Al\Domain\ReadModel\EmployeeList;
use Doctrine\ORM\EntityManagerInterface;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

final class ListEmployeeQuery
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
    public function findAll(int $page = 1, int $limit = 10): Pagerfanta
    {
        $queryBuilder = $this->entityManager->createQueryBuilder()
            ->select(
                sprintf(
                    'NEW %s(employee.id, employee.name, employee.position, employee.salaryScale, employee.firedAt)',
                    EmployeeList::class
                )
            )
            ->from(Employee::class, 'e')
            ->getQuery();

        $employees = new Pagerfanta(new DoctrineORMAdapter($queryBuilder, false, false));
        $employees->setCurrentPage($page);
        $employees->setMaxPerPage($limit);

        return $employees;
    }
}
