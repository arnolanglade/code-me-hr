<?php

namespace spec\Al\ResourceManagement\Application\Handler;

use Al\ResourceManagement\Application\Command\PromoteEmployee;
use Al\ResourceManagement\Application\Handler\PromoteEmployeeHandler;
use Al\ResourceManagement\Domain\EmployeeInterface;
use Al\ResourceManagement\Domain\EmployeeRepositoryInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\Uuid;

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

    function it_handles_a_fire_employee_command($employeeRepository, EmployeeInterface $employee)
    {
        $command = new PromoteEmployee('03a368d5-85b2-46cf-a860-ab22101827d8');
        $command->position = 'position';
        $command->salaryScale = 1;

        $employeeRepository->get(Argument::type(Uuid::class))->willReturn($employee);
        $employee->promote('position', 1)->shouldBeCalled();
        $employeeRepository->add($employee)->shouldBeCalled();

        $this->handle($command)->shouldReturn(null);
    }
}
