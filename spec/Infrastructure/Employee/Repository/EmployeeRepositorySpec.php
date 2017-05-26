<?php

namespace spec\Al\Infrastructure\Employee\Repository;

use Al\Component\Employee\Employee;
use Al\Component\Employee\EmployeeInterface;
use Al\Component\Employee\EmployeeRepositoryInterface;
use Al\Infrastructure\Employee\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\Uuid;

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

    function it_gets_an_employee($entityManager, EmployeeInterface $employee)
    {
        $entityManager->find(Employee::class, Argument::type('string'))->willReturn($employee);

        $this->get(Uuid::uuid4())->shouldReturn($employee);
    }

    function it_throws_an_exception_if_an_employee_does_not_exist($entityManager, Uuid $identifier)
    {
        $entityManager->find(Employee::class, Argument::type('string'))->willReturn(null);

        $this->shouldThrow()->during('get', [Employee::class, Uuid::uuid4()]);
    }

    function it_adds_employee_to_repository($entityManager, EmployeeInterface $employee)
    {
        $entityManager->persist($employee)->shouldBeCalled();
        $entityManager->flush($employee)->shouldBeCalled();

        $this->add($employee)->shouldReturn(null);
    }

    function it_removes_employee_to_repository($entityManager, EmployeeInterface $employee)
    {
        $entityManager->remove($employee)->shouldBeCalled();
        $entityManager->flush($employee)->shouldBeCalled();

        $this->remove($employee)->shouldReturn(null);
    }
}
