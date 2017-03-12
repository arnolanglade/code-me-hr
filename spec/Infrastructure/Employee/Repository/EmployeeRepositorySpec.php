<?php

namespace spec\Al\Infrastructure\Employee\Repository;

use Al\Component\Employee\Employee;
use Al\Component\Employee\EmployeeInterface;
use Al\Component\Employee\EmployeeRepositoryInterface;
use Al\Infrastructure\Employee\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\QueryBuilder;
use Happyr\DoctrineSpecification\Filter\Filter;
use Happyr\DoctrineSpecification\Specification\Specification;
use Pagerfanta\Pagerfanta;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EmployeeRepositorySpec extends ObjectBehavior
{
    function let(EntityManager $entityManager, ClassMetadata $classMetadata)
    {
        $entityManager->getClassMetadata(Employee::class)->willReturn($classMetadata);

        $this->beConstructedWith($entityManager, Employee::class);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(EmployeeRepository::class);
    }

    function it_is_a_employee_repository()
    {
        $this->shouldHaveType(EmployeeRepositoryInterface::class);
    }

    function it_adds_employee_to_repository($entityManager, EmployeeInterface $employee)
    {
        $entityManager->persist($employee)->shouldBeCalled();
        $entityManager->flush()->shouldBeCalled();

        $this->add($employee)->shouldReturn(null);
    }

    function it_removes_employee_to_repository($entityManager, EmployeeInterface $employee)
    {
        $entityManager->remove($employee)->shouldBeCalled();
        $entityManager->flush()->shouldBeCalled();

        $this->remove($employee)->shouldReturn(null);
    }
}
