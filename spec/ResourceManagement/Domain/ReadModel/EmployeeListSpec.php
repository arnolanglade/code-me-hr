<?php

namespace spec\Al\ResourceManagement\Domain\ReadModel;

use Al\ResourceManagement\Domain\ReadModel\EmployeeList;
use PhpSpec\ObjectBehavior;

class EmployeeListSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            '03a368d5-85b2-46cf-a860-ab22101827d8',
            'name',
            'position',
            10,
            new \DateTimeImmutable('2012-12-12')
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(EmployeeList::class);
    }

    function it_has_a_name()
    {
        $this->getName()->shouldReturn('name');
    }

    function it_has_position()
    {
        $this->getPosition()->shouldReturn('position');
    }

    function it_has_salary_scale()
    {
        $this->getSalaryScale()->shouldReturn(10);
    }

    function it_has_fired_date()
    {
        $this->getFiredAt()->shouldReturn('2012-12-12');
    }
}
