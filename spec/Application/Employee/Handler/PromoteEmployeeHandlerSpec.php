<?php

namespace spec\Al\Application\Employee\Handler;

use Al\Application\Employee\Handler\PromoteEmployeeHandler;
use Al\Application\Employee\Command\PromoteEmployee;
use Al\Component\Employee\Employee;
use Al\Component\Employee\EmployeeRepositoryInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PromoteEmployeeHandlerSpec extends ObjectBehavior
{
    function let(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->beConstructedWith($employeeRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(PromoteEmployeeHandler::class);
    }

    function it_handles_a_fire_employee_command($employeeRepository)
    {
        $employee = Employee::hire('al', 'dev', 1);

        $command = new PromoteEmployee('employee-id');
        $command->setPosition('position');
        $command->setSalaryScale(1);

        $employeeRepository->find('employee-id')->willReturn($employee);
//        $employee->promote('position', 1)->shouldBeCalled();
        $employeeRepository->add($employee)->shouldBeCalled();

        $this->handle($command)->shouldReturn(null);
    }
}
