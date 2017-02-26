<?php
declare(strict_types=1);

namespace Al\Infrastructure\Employee\Criteria;

use Happyr\DoctrineSpecification\BaseSpecification;
use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\Specification;

final class SearchCriteria extends BaseSpecification
{
    /** @var string */
    private $name;

    /** @var string */
    private $position;

    /** @var bool */
    private $isFired;

    /**
     * @param string|null $name
     * @param string|null $position
     * @param bool|null   $isFired
     * @param string|null $dqlAlias
     */
    public function __construct(
        string $name = null,
        string $position = null,
        bool $isFired = null,
        string $dqlAlias = null
    ) {
        parent::__construct($dqlAlias);

        $this->name = $name;
        $this->position = $position;
        $this->isFired = $isFired;
    }

    /**
     * @return Specification
     */
    protected function getSpec()
    {
        return Spec::andX(
            new NameCriteria($this->name),
            new PositionCriteria($this->position),
            new isFiredCriteria($this->isFired)
        );

    }
}