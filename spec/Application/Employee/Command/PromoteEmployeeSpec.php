<?php

namespace spec\Al\Application\Employee\Command;

use Al\Application\Employee\Command\PromoteEmployee;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SimpleBus\Message\Name\NamedMessage;

class PromoteEmployeeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('03a368d5-85b2-46cf-a860-ab22101827d8');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(PromoteEmployee::class);
    }

    function it_is_a_named_message()
    {
        $this->shouldImplement(NamedMessage::class);
    }

    function it_has_a_name()
    {
        $this::messageName()->shouldReturn('promote_employee');
    }
}
