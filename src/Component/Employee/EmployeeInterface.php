<?php
declare(strict_types=1);

namespace Component\Employee;

interface EmployeeInterface
{
    /**
     * Hire an employee
     *
     * @param string $name
     * @param string $forPosition
     * @param int    $withSalaryScale
     */
    public static function hire(string $name, string $forPosition, int $withSalaryScale);

    /**
     * Promote him to new position
     *
     * @param string $toNewPosition
     * @param int    $withNewSalaryScale
     */
    public function promote(string $toNewPosition, int $withNewSalaryScale);

    /**
     * Fire him
     */
    public function fire();
}