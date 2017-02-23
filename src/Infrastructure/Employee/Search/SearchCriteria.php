<?php
declare(strict_types=1);

namespace Infrastructure\Employee\Search;

use Happyr\DoctrineSpecification\BaseSpecification;
use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\Specification;

class SearchCriteria extends BaseSpecification
{
    /** @var string */
    private $name;

    /** @var string */
    private $position;

    /**
     * @param string      $name
     * @param string      $position
     * @param string|null $dqlAlias
     */
    public function __construct(string $name = null, string $position = null, string $dqlAlias = null)
    {
        parent::__construct($dqlAlias);

        $this->name = $name;
        $this->position = $position;
    }

    /**
     * @return Specification
     */
    protected function getSpec()
    {
        if (null !== $this->name && null !== $this->position) {
            return Spec::andX(
                new SearchableByName($this->name),
                new SearchableByPosition($this->position)
            );
        }

        if (null !== $this->position) {
            return new SearchableByPosition($this->position);
        }

        if (null !== $this->name) {
            return new SearchableByName($this->name);
        }
    }
}