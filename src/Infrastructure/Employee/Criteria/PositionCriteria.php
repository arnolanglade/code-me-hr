<?php
declare(strict_types=1);

namespace Infrastructure\Employee\Criteria;

use Happyr\DoctrineSpecification\BaseSpecification;
use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\Specification;

final class PositionCriteria extends BaseSpecification
{
    /** @var string */
    private $position;

    /**
     * @param string      $position
     * @param string|null $dqlAlias
     */
    public function __construct(string $position = null, string $dqlAlias = null)
    {
        parent::__construct($dqlAlias);

        $this->position = $position;
    }

    /**
     * @return Specification|null
     */
    protected function getSpec()
    {
        if (null === $this->position) {
            return null;
        }

        return Spec::like('position', $this->position);
    }
}