<?php

namespace spec\Al\Infrastructure\Persistence\Doctrine;

use Al\Infrastructure\Persistence\Doctrine\ListEmployeeQuery;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Happyr\DoctrineSpecification\Specification\Specification;
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
//        $specification->getFilter($queryBuilder, 'employee')->willReturn('employe.name = :name');
//        $specification->modify($queryBuilder, 'employee')->shouldBeCalled();
//
//        $entityManager->createQueryBuilder()->willReturn($queryBuilder);
//
//        $select = sprintf(
//            'NEW %s(employee.id, employee.name, employee.position, employee.salaryScale, employee.firedAt)',
//            DTO::class
//        );
//        $queryBuilder->select($select)->willReturn($queryBuilder);
//        $queryBuilder->from(Employee::class, 'employee', null)->willReturn($queryBuilder);
//        $queryBuilder->andWhere('employe.name = :name')->shouldBeCalled();
//
//        $queryBuilder->getQuery()->shouldBeCalled();
//
//        $this->findAll($specification)->shouldHaveType(Pagerfanta::class);
    }
}
