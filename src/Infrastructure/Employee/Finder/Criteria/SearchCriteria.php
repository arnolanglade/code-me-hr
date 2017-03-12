<?php
declare(strict_types=1);

/*
 * This file is part of the AL labs package
 *
 * (c) Arnaud Langlade
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Al\Infrastructure\Employee\Finder\Criteria;

use Al\Infrastructure\Employee\Finder\Criteria\IsFiredCriteria;
use Al\Infrastructure\Employee\Finder\Criteria\NameCriteria;
use Al\Infrastructure\Employee\Finder\Criteria\PositionCriteria;
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
            new IsFiredCriteria($this->isFired)
        );
    }
}
