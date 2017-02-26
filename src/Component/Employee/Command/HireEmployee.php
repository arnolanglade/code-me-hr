<?php
declare(strict_types=1);

namespace Al\Component\Employee\Command;

final class HireEmployee
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
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition(string $position)
    {
        $this->position = $position;
    }

    /**
     * @return int
     */
    public function getSalaryScale(): int
    {
        return $this->salaryScale;
    }

    /**
     * @param int $withSalaryScale
     */
    public function setSalaryScale(int $withSalaryScale)
    {
        $this->salaryScale = $withSalaryScale;
    }
}
