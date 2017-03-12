<?php

namespace spec\Al\Infrastructure\Employee\Finder\Criteria;

use Al\Infrastructure\Employee\Finder\Criteria\SearchCriteria;
use Happyr\DoctrineSpecification\BaseSpecification;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SearchCriteriaSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('name', 'position', true);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SearchCriteria::class);
    }

    function it_is_a_specification()
    {
        $this->shouldHaveType(BaseSpecification::class);
    }
}
