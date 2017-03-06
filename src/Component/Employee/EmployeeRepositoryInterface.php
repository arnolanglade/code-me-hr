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

use Happyr\DoctrineSpecification\Specification\Specification;

interface EmployeeRepositoryInterface
{
    /**
     * Find an employee by his identifier
     *
     * @param $identifier
     *
     * @return EmployeeInterface|null
     */
    public function find($identifier);

    /**
     * Search employees by criteria
     */
    public function match(Specification $specification);

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
