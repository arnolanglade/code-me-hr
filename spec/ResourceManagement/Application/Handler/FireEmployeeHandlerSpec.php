<?php

namespace spec\Al\ResourceManagement\Application\Handler;

use Al\ResourceManagement\Application\Command\FireEmployee;
use Al\ResourceManagement\Application\Handler\FireEmployeeHandler;
use Al\ResourceManagement\Domain\EmployeeInterface;
use Al\ResourceManagement\Domain\EmployeeRepositoryInterface;
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
        $command->firedAt = $firedAt;

        $employeeRepository->get(Argument::type(Uuid::class))->willReturn($employee);
        $employee->fire($firedAt)->shouldBeCalled();
        $employeeRepository->add($employee)->shouldBeCalled();


        $this->handle($command)->shouldReturn(null);
    }
}
