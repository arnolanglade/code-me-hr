<?php

namespace spec\Al\Component\Employee\Command;

use Al\Component\Employee\Command\FireEmployee;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FireEmployeeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FireEmployee::class);
    }
}
