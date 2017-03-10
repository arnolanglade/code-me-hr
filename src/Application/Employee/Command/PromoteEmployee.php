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

namespace Al\Application\Employee\Command;

use SimpleBus\Message\Name\NamedMessage;

final class PromoteEmployee implements NamedMessage
{
    /** @var string */
    private $id;

    /** @var string */
    private $position = '';

    /** @var int */
    private $salaryScale = 0;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return (string) $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return int
     */
    public function getSalaryScale()
    {
        return (int) $this->salaryScale;
    }

    /**
     * @param int $withSalaryScale
     */
    public function setSalaryScale($withSalaryScale)
    {
        $this->salaryScale = $withSalaryScale;
    }

    /**
     * {@inheritdoc}
     */
    public static function messageName()
    {
        return 'promote_employee';
    }
}
