<?php

namespace spec\Al\Infrastructure\Employee\Criteria;

use Al\Infrastructure\Employee\Criteria\NameCriteria;
use Happyr\DoctrineSpecification\BaseSpecification;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NameCriteriaSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('name');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(NameCriteria::class);
    }

    function it_is_a_specification()
    {
        $this->shouldHaveType(BaseSpecification::class);
    }
}
