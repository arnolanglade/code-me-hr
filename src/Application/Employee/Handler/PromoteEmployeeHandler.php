<?php
declare(strict_types=1);

namespace Al\Application\Employee\Handler;

use Al\Application\Employee\Command\PromoteEmployee;
use Al\Component\Employee\EmployeeRepositoryInterface;

final class PromoteEmployeeHandler
{
    /** @var EmployeeRepositoryInterface */
    private $employeeRepository;

    /**
     * @param EmployeeRepositoryInterface $employeeRepository
     */
    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * @param PromoteEmployee $command
     */
    public function handle(PromoteEmployee $command)
    {
        $employee = $this->employeeRepository->find($command->getId());

        $employee->promote($command->getPosition(), $command->getSalaryScale());

        $this->employeeRepository->add($employee);
    }
}
