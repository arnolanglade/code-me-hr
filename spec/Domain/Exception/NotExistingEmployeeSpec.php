<?php

namespace spec\Al\Domain\Exception;

use Al\Domain\Exception\NotExistingEmployee;
use PhpSpec\ObjectBehavior;

class NotExistingEmployeeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('wrong identidier');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(NotExistingEmployee::class);
    }

    function it_is_an_exception()
    {
        $this->shouldHaveType(\Exception::class);
    }

    function it_has_a_message()
    {
        $this->getMessage()->shouldReturn('There is not employee with identifier "wrong identidier"');
    }
}
