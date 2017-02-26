<?php

namespace spec\Al\Component\Employee\Command;

use Al\Component\Employee\Command\PromoteEmployee;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PromoteEmployeeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(PromoteEmployee::class);
    }
}
