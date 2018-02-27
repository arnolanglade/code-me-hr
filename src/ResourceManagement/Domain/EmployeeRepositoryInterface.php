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

namespace Al\ResourceManagement\Domain;

use Al\ResourceManagement\Domain\Exception\NotExistingEmployee;
use Ramsey\Uuid\UuidInterface;

interface EmployeeRepositoryInterface
{
    /**
     * Find an employee by his identifier
     *
     * @param UuidInterface $identifier
     *
     * @return EmployeeInterface
     *
     * @throws NotExistingEmployee
     */
    public function get(UuidInterface $identifier): EmployeeInterface;

    /**
     * Add an employee
     *
     * @param EmployeeInterface $employee
     */
    public function add(EmployeeInterface $employee);

    /**
     * Remove an employee
     *
     * @param EmployeeInterface $employee
     */
    public function remove(EmployeeInterface $employee);
}
