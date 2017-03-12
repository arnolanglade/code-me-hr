<?php

namespace spec\Al\Infrastructure\Specification;

use Al\Infrastructure\Specification\NewX;
use Doctrine\ORM\QueryBuilder;
use Happyr\DoctrineSpecification\Specification\Specification;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NewXSpec extends ObjectBehavior
{
    function let(Specification $specification)
    {
        $this->beConstructedWith($specification, Employee::class);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(NewX::class);
    }

    function it_is_a_specification()
    {
        $this->shouldImplement(Specification::class);
    }

    function it_has_filters($specification, QueryBuilder $queryBuilder)
    {
        $specification->getFilter($queryBuilder, 'alias')->shouldbeCalled();

        $this->getFilter($queryBuilder, 'alias')->shouldReturn('');
    }

    function it_adds_new_operator_in_new($specification, QueryBuilder $queryBuilder)
    {
        $queryBuilder->select(
            sprintf('NEW %s(alias.id, alias.name)', Employee::class)
        )->shouldbeCalled();

        $specification->modify($queryBuilder, 'alias')->shouldbeCalled();

        $this->modify($queryBuilder, 'alias')->shouldReturn(null);
    }
}

final class Employee
{
    public function __construct(string $id, string $name)
    {
    }
}

