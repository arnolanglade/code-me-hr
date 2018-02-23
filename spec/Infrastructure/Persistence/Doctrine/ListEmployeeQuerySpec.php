<?php

namespace spec\Al\Infrastructure\Persistence\Doctrine;

use Al\Domain\Employee;
use Al\Domain\ReadModel\EmployeeList;
use Al\Infrastructure\Persistence\Doctrine\ListEmployeeQuery;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Happyr\DoctrineSpecification\Specification\Specification;
use Pagerfanta\Pagerfanta;
use PhpSpec\ObjectBehavior;

class ListEmployeeQuerySpec extends ObjectBehavior
{
    function let(EntityManagerInterface $entityManager)
    {
        $this->beConstructedWith($entityManager);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ListEmployeeQuery::class);
    }

    function it_finds_employees_that_match_specification(
        $entityManager,
        Specification $specification,
        QueryBuilder $queryBuilder
    ) {
        $entityManager->createQueryBuilder()->willReturn($queryBuilder);

        $select = sprintf(
            'NEW %s(employee.id, employee.name, employee.position, employee.salaryScale, employee.firedAt)',
            EmployeeList::class
        );
        $queryBuilder->select($select)->willReturn($queryBuilder);
        $queryBuilder->from(Employee::class, 'e', null)->willReturn($queryBuilder);

        $queryBuilder->getQuery()->shouldBeCalled();

        $this->findAll()->shouldHaveType(Pagerfanta::class);
    }
}
