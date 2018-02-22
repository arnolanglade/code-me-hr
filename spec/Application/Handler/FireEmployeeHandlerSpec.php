<?php

namespace spec\Al\Application\Handler;

use Al\Application\Command\FireEmployee;
use Al\Application\Handler\FireEmployeeHandler;
use Al\Domain\EmployeeInterface;
use Al\Domain\EmployeeRepositoryInterface;
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
