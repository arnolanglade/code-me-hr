<?php
declare(strict_types=1);

namespace Al\Application\Employee\Handler;

use Al\Application\Employee\Command\HireEmployee;
use Al\Component\Employee\Employee;
use Al\Component\Employee\EmployeeRepositoryInterface;

final class HireEmployeeHandler
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
     * @param HireEmployee $command
     */
    public function handle(HireEmployee $command)
    {
        $employee = Employee::hire(
            $command->getName(),
            $command->getPosition(),
            $command->getSalaryScale()
        );

        $this->employeeRepository->add($employee);
    }
}
