<?php

namespace spec\Al\Infrastructure\Fixtures;

use Al\Infrastructure\Fixtures\FileLocator;
use Hautelook\AliceBundle\FixtureLocatorInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FileLocatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FileLocator::class);
    }

    function it_is_fixture_locator()
    {
        $this->shouldImplement(FixtureLocatorInterface::class);
    }

    function it_locates_the_fixtures_files()
    {
        $path = __DIR__.'/../../../src/Infrastructure/Employee/Resources/fixtures/employee.yml';

        $this->locateFiles([], '')->shouldReturn([realpath($path)]);
    }
}
