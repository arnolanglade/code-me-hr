<?php
declare(strict_types=1);

namespace Al\Infrastructure\Employee\Criteria;

use Happyr\DoctrineSpecification\BaseSpecification;
use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\Specification;

final class NameCriteria extends BaseSpecification
{
    /** @var string */
    private $name;

    /**
     * @param string      $position
     * @param string|null $dqlAlias
     */
    public function __construct(string $position = null, string $dqlAlias = null)
    {
        parent::__construct($dqlAlias);

        $this->name = $position;
    }

    /**
     * @return Specification|null
     */
    protected function getSpec()
    {
        if (null === $this->name) {
            return null;
        }

        return Spec::like('name', $this->name);
    }
}