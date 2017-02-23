<?php
declare(strict_types=1);

namespace Infrastructure\Employee\Search;

use Happyr\DoctrineSpecification\BaseSpecification;
use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\Specification;

class SearchableByPosition extends BaseSpecification
{
    /** @var string */
    private $position;

    /**
     * @param string      $position
     * @param string|null $dqlAlias
     */
    public function __construct(string $position, string $dqlAlias = null)
    {
        parent::__construct($dqlAlias);

        $this->position = $position;
    }

    /**
     * @return Specification
     */
    protected function getSpec()
    {
        return Spec::like('position', $this->position);
    }
}