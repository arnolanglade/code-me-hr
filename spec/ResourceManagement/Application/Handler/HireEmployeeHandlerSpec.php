<?php

namespace spec\Al\ResourceManagement\Application\Handler;

use Al\ResourceManagement\Application\Command\HireEmployee;
use Al\ResourceManagement\Application\Handler\HireEmployeeHandler;
use Al\ResourceManagement\Domain\Employee;
use Al\ResourceManagement\Domain\EmployeeRepositoryInterface;
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
        $command->name ='name';
        $command->position = 'position';
        $command->salaryScale = 1;

        $employeeRepository->add(Argument::type(Employee::class))->shouldBeCalled();

        $this->handle($command)->shouldReturn(null);
    }
}
