<?php

namespace Component\Employee;

use Happyr\DoctrineSpecification\Specification\Specification;
use Ramsey\Uuid\Uuid;

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
    public function search(Specification $specification);

    /**
     * Add an employee
     *
     * @param EmployeeInterface $employee
     */
    public function save(EmployeeInterface $employee);

    /**
     * Remove an employee
     *
     * @param EmployeeInterface $employee
     */
    public function remove(EmployeeInterface $employee);
}