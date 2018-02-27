<?php

namespace spec\Al\Infrastructure\Persistence\Doctrine\Fixtures;

use Al\Infrastructure\Persistence\Doctrine\Fixtures\FileLocator;
use Hautelook\AliceBundle\FixtureLocatorInterface;
use PhpSpec\ObjectBehavior;

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

    /**
     * @error this test should not depend on the file system
     */
    function it_locates_the_fixtures_files()
    {
        $path = __DIR__.'/../../../../../src/Infrastructure/Persistence/Doctrine/Resources/fixtures/employee.yml';

        $this->locateFiles([], '')->shouldReturn([realpath($path)]);
    }
}
