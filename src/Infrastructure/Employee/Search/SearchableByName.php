<?php
declare(strict_types=1);

namespace Infrastructure\Employee\Search;

use Happyr\DoctrineSpecification\BaseSpecification;
use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\Specification;

class SearchableByName extends BaseSpecification
{
    /** @var string */
    private $name;

    /**
     * @param string      $position
     * @param string|null $dqlAlias
     */
    public function __construct(string $position, string $dqlAlias = null)
    {
        parent::__construct($dqlAlias);

        $this->name = $position;
    }

    /**
     * @return Specification
     */
    protected function getSpec()
    {
        return Spec::like('name', $this->name);
    }
}