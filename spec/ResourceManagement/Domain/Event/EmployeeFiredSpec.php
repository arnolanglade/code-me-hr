<?php

namespace spec\Al\ResourceManagement\Domain\Event;

use Al\ResourceManagement\Domain\Event\EmployeeFired;
use PhpSpec\ObjectBehavior;
use SimpleBus\Message\Name\NamedMessage;

class EmployeeFiredSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('employee-id', 'name', 'position');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(EmployeeFired::class);
    }

    function it_is_a_named_message()
    {
        $this->shouldImplement(NamedMessage::class);
    }

    function it_has_a_name()
    {
        $this::messageName()->shouldReturn('employee_fired');
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
