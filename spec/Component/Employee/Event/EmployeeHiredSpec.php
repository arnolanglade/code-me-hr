<?php

namespace spec\Al\Component\Employee\Event;

use Al\Component\Employee\Event\EmployeeHired;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SimpleBus\Message\Name\NamedMessage;

class EmployeeHiredSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('employee-id', 'name', 'position');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(EmployeeHired::class);
    }

    function it_is_a_named_message()
    {
        $this->shouldImplement(NamedMessage::class);
    }

    function it_has_a_name()
    {
        $this::messageName()->shouldReturn('employee_hired');
    }

    function it_has_a_employee_id()
    {
        $this->getEmployeeId()->shouldReturn('employee-id');
    }

    function it_has_a_employee_name()
    {
        $this->getEmployeeName()->shouldReturn('name');
    }

    function it_has_a_employee_position()
    {
        $this->getEmployeePosition()->shouldReturn('position');
    }
}
