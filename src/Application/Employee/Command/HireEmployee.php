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

final class HireEmployee implements NamedMessage
{
    /** @var string */
    private $name = '';

    /** @var string */
    private $position = '';

    /** @var int */
    private $salaryScale = 0;

    /**
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPosition(): string
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
    public function getSalaryScale(): int
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
    public static function messageName(): string
    {
        return 'hire_employee';
    }
}
