<?php

namespace spec\Al\Application\Employee\Command;

use Al\Application\Employee\Command\HireEmployee;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SimpleBus\Message\Name\NamedMessage;

class HireEmployeeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(HireEmployee::class);
    }

    function it_is_a_named_message()
    {
        $this->shouldImplement(NamedMessage::class);
    }

    function it_has_a_name()
    {
        $this::messageName()->shouldReturn('hire_employee');
    }
}
