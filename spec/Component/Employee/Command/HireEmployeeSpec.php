<?php

namespace spec\Al\Component\Employee\Command;

use Al\Component\Employee\Command\HireEmployee;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HireEmployeeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(HireEmployee::class);
    }
}
