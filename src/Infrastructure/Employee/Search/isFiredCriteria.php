<?php
declare(strict_types=1);

namespace Infrastructure\Employee\Search;

use Happyr\DoctrineSpecification\BaseSpecification;
use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\Specification;

final class isFiredCriteria extends BaseSpecification
{
    /** @var bool */
    private $isFired = false;

    /**
     * @param bool|null   $isFired
     * @param string|null $dqlAlias
     */
    public function __construct(bool $isFired, string $dqlAlias = null)
    {
        parent::__construct($dqlAlias);

        $this->isFired = $isFired;
    }

    /**
     * @return Specification|null
     */
    protected function getSpec()
    {
        if (false === $this->isFired) {
            return Spec::isNull('firedAt');
        }

        return Spec::isNotNull('firedAt');
    }
}