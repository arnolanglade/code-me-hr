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

use Al\ResourceManagement\Domain\Event\EmployeeFired;
use Al\ResourceManagement\Domain\Event\EmployeeHired;
use Al\ResourceManagement\Domain\Event\EmployeePromoted;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
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

    private function __construct(
        UuidInterface $identifier,
        string $name,
        string $forPosition,
        int $withSalaryScale,
        \DateTimeInterface $hiredAt
    ) {
        $this->id = $identifier;
        $this->name = $name;
        $this->position = $forPosition;
        $this->salaryScale = $withSalaryScale;
        $this->hiredAt = $hiredAt;
        $this->firedAt = null;

        $this->record(new EmployeeHired((string)$this->id, $this->name, $this->position));
    }

    /**
     * {@inheritdoc}
     */
    public static function hire(
        UuidInterface $identifier,
        string $name,
        string $forPosition,
        int $withSalaryScale,
        \DateTimeInterface $hiredAt
    ) {
        return new self($identifier, $name, $forPosition, $withSalaryScale, $hiredAt);
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
}
