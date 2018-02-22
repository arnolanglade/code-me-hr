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

namespace Al\Application\Handler;

use Al\Application\Command\HireEmployee;
use Al\Component\Employee\Employee;
use Al\Component\Employee\EmployeeRepositoryInterface;
use Ramsey\Uuid\Uuid;

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
            Uuid::uuid4(),
            $command->name,
            $command->position,
            (int) $command->salaryScale,
            $command->hiredAt
        );

        $this->employeeRepository->add($employee);
    }
}
