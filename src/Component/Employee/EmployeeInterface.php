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

namespace Al\Component\Employee;

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
     *
     * @param \DateTime $firedAt
     */
    public function fire(\DateTime $firedAt);
}
