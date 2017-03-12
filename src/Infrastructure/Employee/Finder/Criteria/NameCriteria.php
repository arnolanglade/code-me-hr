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
