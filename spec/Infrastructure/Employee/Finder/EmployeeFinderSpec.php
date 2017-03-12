<?php

namespace spec\Al\Infrastructure\Employee\Finder;

use Al\Application\Employee\DTO\Employee AS DTO;
use Al\Component\Employee\Employee;
use Al\Infrastructure\Employee\Finder\EmployeeFinder;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Happyr\DoctrineSpecification\Specification\Specification;
use Pagerfanta\Pagerfanta;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EmployeeFinderSpec extends ObjectBehavior
{
    function let(EntityManagerInterface $entityManager)
    {
        $this->beConstructedWith($entityManager);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(EmployeeFinder::class);
    }

    function it_finds_employees_that_match_specification(
        $entityManager,
        Specification $specification,
        QueryBuilder $queryBuilder
    ) {
        $specification->getFilter($queryBuilder, 'employee')->willReturn('employe.name = :name');
        $specification->modify($queryBuilder, 'employee')->shouldBeCalled();

        $entityManager->createQueryBuilder()->willReturn($queryBuilder);

        $select = sprintf(
            'NEW %s(employee.id, employee.name, employee.position, employee.salaryScale, employee.firedAt)',
            DTO::class
        );
        $queryBuilder->select($select)->willReturn($queryBuilder);
        $queryBuilder->from(Employee::class, 'employee', null)->willReturn($queryBuilder);
        $queryBuilder->andWhere('employe.name = :name')->shouldBeCalled();

        $queryBuilder->getQuery()->shouldBeCalled();

        $this->findAll($specification)->shouldHaveType(Pagerfanta::class);
    }
}
