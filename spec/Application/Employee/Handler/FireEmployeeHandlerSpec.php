<?php

namespace spec\Al\Application\Employee\Handler;

use Al\Application\Employee\Command\FireEmployee;
use Al\Application\Employee\Handler\FireEmployeeHandler;
use Al\Component\Employee\Employee;
use Al\Component\Employee\EmployeeRepositoryInterface;
use PhpSpec\ObjectBehavior;

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

    function it_handles_a_fire_employee_command($employeeRepository) {
        $firedAt = new \DateTime();
        $command = new FireEmployee('employee-id');
        $command->setFiredAt($firedAt);

        $employee = Employee::hire('al', 'dev', 1);

        $employeeRepository->find('employee-id')->willReturn($employee);
//        $employee->fire($firedAt)->shouldBeCalled();
        $employeeRepository->add($employee)->shouldBeCalled();


        $this->handle($command)->shouldReturn(null);
    }
}
