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

use Ramsey\Uuid\UuidInterface;

interface EmployeeInterface
{
    /**
     * Hire an employee
     *
     * @param UuidInterface      $identifier
     * @param string             $name
     * @param string             $forPosition
     * @param int                $withSalaryScale
     * @param \DateTimeInterface $hiredAt
     */
    public static function hire(
        UuidInterface $identifier,
        string $name,
        string $forPosition,
        int $withSalaryScale,
        \DateTimeInterface $hiredAt
    );

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
