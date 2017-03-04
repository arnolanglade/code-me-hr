<?php

namespace spec\Al\Application\Employee\Handler;

use Al\Application\Employee\Handler\HireEmployeeHandler;
use Al\Application\Employee\Command\HireEmployee;
use Al\Component\Employee\Employee;
use Al\Component\Employee\EmployeeRepositoryInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HireEmployeeHandlerSpec extends ObjectBehavior
{
    function let(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->beConstructedWith($employeeRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(HireEmployeeHandler::class);
    }

    function it_handles_a_fire_employee_command($employeeRepository)
    {
        $command = new HireEmployee();
        $command->setName('name');
        $command->setPosition('position');
        $command->setSalaryScale(1);

        $employeeRepository->add(Argument::type(Employee::class))->shouldBeCalled();

        $this->handle($command)->shouldReturn(null);
    }
}
