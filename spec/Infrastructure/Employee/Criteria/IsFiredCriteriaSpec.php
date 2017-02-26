<?php

namespace spec\Al\Infrastructure\Employee\Criteria;

use Al\Infrastructure\Employee\Criteria\IsFiredCriteria;
use Happyr\DoctrineSpecification\BaseSpecification;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IsFiredCriteriaSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(true);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(IsFiredCriteria::class);
    }

    function it_is_a_specification()
    {
        $this->shouldHaveType(BaseSpecification::class);
    }
}
