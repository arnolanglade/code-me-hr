<?php

namespace spec\Al\Application\Employee\Command;

use Al\Application\Employee\Command\FireEmployee;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SimpleBus\Message\Name\NamedMessage;

class FireEmployeeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('id');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(FireEmployee::class);
    }

    function it_is_a_named_message()
    {
        $this->shouldImplement(NamedMessage::class);
    }

    function it_has_a_name()
    {
        $this::messageName()->shouldReturn('fire_employee');
    }
}
