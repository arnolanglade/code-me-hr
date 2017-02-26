<?php

namespace spec\Al\Infrastructure\Employee\Criteria;

use Al\Infrastructure\Employee\Criteria\PositionCriteria;
use Happyr\DoctrineSpecification\BaseSpecification;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PositionCriteriaSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('position');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(PositionCriteria::class);
    }

    function it_is_a_specification()
    {
        $this->shouldHaveType(BaseSpecification::class);
    }
}
