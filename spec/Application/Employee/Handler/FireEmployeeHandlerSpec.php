<?php

namespace spec\Al\Application\Employee\Handler;

use Al\Application\Employee\Command\FireEmployee;
use Al\Application\Employee\Handler\FireEmployeeHandler;
use Al\Component\Employee\Employee;
use Al\Component\Employee\EmployeeInterface;
use Al\Component\Employee\EmployeeRepositoryInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\Uuid;

class FireEmployeeHandlerSpec extends ObjectBehavior
{
    function let(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->beConstructedWith($employeeRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(FireEmployeeHandler::class);
    }

    function it_handles_a_fire_employee_command($employeeRepository, EmployeeInterface $employee) {
        $firedAt = new \DateTime();
        $command = new FireEmployee('03a368d5-85b2-46cf-a860-ab22101827d8');
        $command->setFiredAt($firedAt);

        $employeeRepository->find(Argument::type(Uuid::class))->willReturn($employee);
        $employee->fire($firedAt)->shouldBeCalled();
        $employeeRepository->add($employee)->shouldBeCalled();


        $this->handle($command)->shouldReturn(null);
    }
}
