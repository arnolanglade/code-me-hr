<?php

namespace spec\Al\Component\Employee;

use Al\Component\Employee\Employee;
use Al\Component\Employee\EmployeeInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SimpleBus\Message\Recorder\ContainsRecordedMessages;

class EmployeeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Employee::class);
    }

    function it_is_an_employee()
    {
        $this->shouldImplement(EmployeeInterface::class);
    }

    function it_contains_recorded_message()
    {
        $this->shouldImplement(ContainsRecordedMessages::class);
    }
}
