<?php
declare(strict_types=1);

namespace Al\Application\Employee\Handler;

use Al\Application\Employee\Command\FireEmployee;
use Al\Component\Employee\EmployeeRepositoryInterface;

final class FireEmployeeHandler
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
     * @param \Al\Application\Employee\Command\FireEmployee $command
     */
    public function handle(FireEmployee $command)
    {
        $employee = $this->employeeRepository->find($command->getId());

        $employee->fire($command->getFiredAt());

        $this->employeeRepository->add($employee);
    }
}
