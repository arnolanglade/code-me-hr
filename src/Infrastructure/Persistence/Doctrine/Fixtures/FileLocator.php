<?php
declare(strict_types=1);

namespace Al\Infrastructure\Persistence\Doctrine\Fixtures;

use Hautelook\AliceBundle\FixtureLocatorInterface;
use Symfony\Component\Finder\Finder as SymfonyFinder;

final class FileLocator implements FixtureLocatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function locateFiles(array $bundles, string $environment): array
    {
        $path = sprintf('%s/../Resources/fixtures', __DIR__);
        $path = realpath($path);
        if (false === $path || false === file_exists($path)) {
            return [];
        }

        $files = SymfonyFinder::create()->files()->in($path)->depth(0)->name('/.*\.(ya?ml|php)$/i');

        // this sort helps to set an order with filename ( "001-root-level-fixtures.yml", "002-another-level-fixtures.yml", ... )
        $files = $files->sort(function ($a, $b) {
            return strcasecmp($a, $b);
        });

        $fixtureFiles = [];
        foreach ($files as $file) {
            $fixtureFiles[] = $file->getRealPath();
        }

        return $fixtureFiles;
    }
}
