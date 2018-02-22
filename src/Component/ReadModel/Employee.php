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

namespace Al\Component\ReadModel;

final class Employee
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $position;

    /** @var int */
    private $salaryScale;

    /** @var string */
    private $firedAt;

    public function __construct(string $id, string $name, string $position, int $salaryScale, string $firedAt = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->position = $position;
        $this->salaryScale = $salaryScale;
        $this->firedAt = $firedAt;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @return int
     */
    public function getSalaryScale(): int
    {
        return $this->salaryScale;
    }

    /**
     * @return string
     */
    public function getFiredAt(): string
    {
        return $this->firedAt;
    }
}
