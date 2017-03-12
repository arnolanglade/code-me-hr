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

use Al\Component\Employee\Event\EmployeeFired;
use Al\Component\Employee\Event\EmployeeHired;
use Al\Component\Employee\Event\EmployeePromoted;
use Ramsey\Uuid\Uuid;
use SimpleBus\Message\Recorder\ContainsRecordedMessages;
use SimpleBus\Message\Recorder\PrivateMessageRecorderCapabilities;

final class Employee implements EmployeeInterface, ContainsRecordedMessages
{
    use PrivateMessageRecorderCapabilities;

    /** @var Uuid */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $position;

    /** @var int */
    private $salaryScale;

    /** @var \DateTimeInterface */
    private $firedAt;

    private function __construct(string $name, string $position, int $salaryScale)
    {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->position = $position;
        $this->salaryScale = $salaryScale;
        $this->firedAt = null;

        $this->record(new EmployeeHired((string)$this->id, $this->name, $this->position));
    }

    /**
     * {@inheritdoc}
     */
    public static function hire(string $name, string $forPosition, int $withSalaryScale)
    {
        return new self($name, $forPosition, $withSalaryScale);
    }

    /**
     * {@inheritdoc}
     */
    public function promote(string $toNewPosition, int $withNewSalaryScale)
    {
        $this->position = $toNewPosition;
        $this->salaryScale = $withNewSalaryScale;

        $this->record(new EmployeePromoted((string)$this->id, $this->name, $this->position));
    }

    /**
     * {@inheritdoc}
     */
    public function fire(\DateTime $firedAt)
    {
        $this->firedAt = $firedAt;

        $this->record(new EmployeeFired((string)$this->id, $this->name, $this->position));
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @return int
     */
    public function getSalaryScale(): int
    {
        return $this->salaryScale;
    }
}
