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

namespace Al\ResourceManagement\Application\Handler;

use Al\ResourceManagement\Application\Command\FireEmployee;
use Al\ResourceManagement\Domain\EmployeeRepositoryInterface;

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
     * @param FireEmployee $command
     *
     * @throws \Al\ResourceManagement\Domain\Exception\NotExistingEmployee
     */
    public function handle(FireEmployee $command)
    {
        $employee = $this->employeeRepository->get($command->id);

        $employee->fire($command->firedAt);

        $this->employeeRepository->add($employee);
    }
}
