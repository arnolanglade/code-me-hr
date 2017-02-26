<?php
declare(strict_types=1);

namespace Al\AppBundle\Employee;

final class PromoteEmployeeCommand
{
    /** @var string */
    private $newPosition = '';
    /** @var int */
    private $newSalaryScale = 0;

    /**
     * @return string
     */
    public function getNewPosition(): string
    {
        return $this->newPosition;
    }

    /**
     * @param string $newPosition
     */
    public function setNewPosition(string $newPosition)
    {
        $this->newPosition = $newPosition;
    }

    /**
     * @return int
     */
    public function getNewSalaryScale(): int
    {
        return $this->newSalaryScale;
    }

    /**
     * @param int $newSalaryScale
     */
    public function setNewSalaryScale(int $newSalaryScale)
    {
        $this->newSalaryScale = $newSalaryScale;
    }
}