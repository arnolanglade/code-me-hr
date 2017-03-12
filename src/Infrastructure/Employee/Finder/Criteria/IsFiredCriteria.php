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

use Happyr\DoctrineSpecification\BaseSpecification;
use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\Specification;

final class IsFiredCriteria extends BaseSpecification
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
